<?php
/**
 * Created by IntelliJ IDEA.
 * User: yaizuuuu
 * Date: 2018/10/18
 * Time: 1:04
 */

namespace App\Repositories\User;


use App\Eloquent\User;
use Illuminate\Database\Eloquent\Collection;

class EloquentUserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all(): Collection
    {
        return $this->user->all();
    }

    public function find(int $id): ?User
    {
        return $this->user->find($id);
    }

    public function create(array $input): User
    {
        return $this->user->create();
    }
}
