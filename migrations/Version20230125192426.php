<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230125192426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates `user_todo` and `todo` tables and its relationships';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE `todo` (
                id CHAR(36) NOT NULL PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                description VARCHAR(255) NOT NULL,
                done TINYINT(1) NOT NULL DEFAULT 0,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at DateTIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                INDEX IDX_user_todo_name (name)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = innoDB'
        );

        $this->addSql('CREATE TABLE `user_todos` (
                user_id CHAR(36) NOT NULL,
                todo_id CHAR(36) NOT NULL,
                INDEX IDX_user_id_todo (user_id),
                INDEX IDX_todo_id_user (todo_id),
                CONSTRAINT FK_user_id_todo FOREIGN KEY (user_id) REFERENCES `user` (id) ON UPDATE CASCADE ON DELETE CASCADE,
                CONSTRAINT FK_todo_id_user FOREIGN KEY (todo_id) REFERENCES `todo` (id) ON UPDATE CASCADE ON DELETE CASCADE 
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = innoDB'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `todo`');
        $this->addSql('DROP TABLE `user_todos`');
    }
}
