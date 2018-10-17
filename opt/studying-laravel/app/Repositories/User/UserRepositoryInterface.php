<?php
/**
 * Created by IntelliJ IDEA.
 * User: yaizuuuu
 * Date: 2018/10/17
 * Time: 23:34
 */

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function all();

    public function find(int $id);

    public function create(array $input);
}
