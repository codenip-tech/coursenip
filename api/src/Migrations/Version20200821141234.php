<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200821141234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates `profile` table and its relationship with `user`';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE `profile` (
                id CHAR(36) NOT NULL PRIMARY KEY,
                type VARCHAR(10) NOT NULL,
                user_id CHAR(36) NOT NULL,
                name VARCHAR(50) DEFAULT NULL,
                last_name VARCHAR(50) DEFAULT NULL,
                title VARCHAR(50) DEFAULT NULL,
                bio TEXT DEFAULT NULL,
                website VARCHAR(250) DEFAULT NULL,
                twitter VARCHAR(250) DEFAULT NULL,
                facebook VARCHAR(250) DEFAULT NULL,
                linkedin VARCHAR(250) DEFAULT NULL,
                youtube VARCHAR(250) DEFAULT NULL,
                INDEX IDX_profile_type (type),
                INDEX IDX_profile_user_id (user_id),
                CONSTRAINT FK_profile_user_id FOREIGN KEY (user_id) REFERENCES `user` (id) ON UPDATE CASCADE ON DELETE CASCADE
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `profile`');
    }
}
