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
        $this->addSql('CREATE TABLE `user_todo` (
        
        )');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
