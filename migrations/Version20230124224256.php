<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124224256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates `user_todo` table and its relationships';
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
                INDEX IDX_user_todo_name (name),
                CONSTRAINT FK_user_todo_id FOREIGN KEY (id) REFERENCES `user` (id) ON UPDATE CASCADE ON DELETE CASCADE 
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = innoDB'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `todo`');
    }
}
