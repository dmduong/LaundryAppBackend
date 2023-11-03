<?php
namespace App\Services;

use App\Exceptions\ErrorsException;
use App\Interfaces\AccountEloquentRepositoryInterFace;
use App\Interfaces\RoleEloquentRepositoryInterface;
use App\Traits\Paginations;
use App\Traits\UniqueCodeTrait;
use Illuminate\Support\Facades\DB;

class RoleService
{
    use UniqueCodeTrait, Paginations;
    protected RoleEloquentRepositoryInterface $roleEloquentRepository;
    protected AccountEloquentRepositoryInterFace $accountEloquentRepository;

    public function __construct(
        RoleEloquentRepositoryInterface $roleEloquentRepository,
        AccountEloquentRepositoryInterFace $accountEloquentRepository
    ) {
        $this->roleEloquentRepository = $roleEloquentRepository;
        $this->accountEloquentRepository = $accountEloquentRepository;
    }

    public function getAllRole($conditions)
    {
        return $this->paginations($this->roleEloquentRepository->getAllRole($conditions), $conditions);
    }

    public function find(int $roleId)
    {
        $result = $this->roleEloquentRepository->find($roleId);

        if (is_null($result)) {
            throw new ErrorsException("Vai trò không tồn tại.");
        }

        return $result;
    }

    public function assignPermission(array $conditions, int $roleId)
    {
        $result = $this->find($roleId);

        // TODO: reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        return $result->syncPermissions($conditions['permission_id']);
    }

    public function update($data, $roleId)
    {
        $this->find($roleId);
        return $this->roleEloquentRepository->update($roleId, $data);
    }

    public function destroy($roleId)
    {
        $this->find($roleId);
        return $this->roleEloquentRepository->delete($roleId);
    }

    public function roleAssignAccount($conditions, $roleId): void
    {
        try {
            // reset cached roles and permissions
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

            DB::beginTransaction();

            $accountId = $conditions['db_account_id'];

            $role = $this->find($roleId);

            $account = $this->accountEloquentRepository->find($accountId);

            if (is_null($account)) {
                throw new ErrorsException('Người dùng không tồn tại.');
            }

            $account->syncRoles($role);

            $account->syncPermissions($role->permissions);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            abort($th->getMessage(), $th->getCode());
        }
    }
}