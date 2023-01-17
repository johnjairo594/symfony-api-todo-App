<?php

namespace app\src\Infrastructure\Repository\UserRepository;

use App\src\Domain\User\Model\User;
use App\src\Infracstructure\Repository\BaseRepository\BaseRepository;
use App\src\Infrastructure\Exceptions\User\UserNotFoundException;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

class UserRepository extends BaseRepository
{

    protected static function entityClass(): string
    {
        return User::class;
    }

    public function findOneByEmailOrFail(string $email): User
    {
        if (null=== $user = $this->objectRepository->findOneBy(['email' => $email])){
            throw UserNotFoundException::fromEmail($email);
        }

        return $user;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function save(User $user): void
    {
        $this->saveEntity($user);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function remove(User $user): void
    {
        $this->removeEntity($user);
    }
}