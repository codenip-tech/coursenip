<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200819103743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates `skill`, `course`, `course_requirement`, `course_result`, `lesson`, `lesson_requirement`, `lesson_result` and `course_enrollment` tables and its relationships';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE `skill` (
                    id CHAR(36) NOT NULL PRIMARY KEY,
                    name VARCHAR(50) NOT NULL,
                    slug VARCHAR(50) NOT NULL,
                    INDEX IDX_name (name)
                ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE `course` (
                    id CHAR(36) NOT NULL PRIMARY KEY,
                    image_path VARCHAR(300) NOT NULL,
                    name VARCHAR(50) NOT NULL,
                    slug VARCHAR(50) NOT NULL,
                    description TEXT NOT NULL,
                    duration SMALLINT UNSIGNED,
                    create_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    update_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    score SMALLINT UNSIGNED,
                    creator_id CHAR(36) NOT NULL,
                    INDEX IDX_course_name (name),
                    INDEX IDX_creator_id (creator_id),
                    CONSTRAINT FK_course_creator FOREIGN KEY (creator_id) REFERENCES `user` (id) ON UPDATE CASCADE ON DELETE CASCADE
                ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE `course_requirement` (
                    course_id CHAR(36) NOT NULL,
                    skill_id CHAR(36) NOT NULL,
                    INDEX IDX_course_requirement_course_id (course_id),
                    INDEX IDX_course_requirement_skill_id (skill_id),
                    CONSTRAINT FK_course_requirement_course_id FOREIGN KEY (course_id) REFERENCES `course` (id) ON UPDATE CASCADE ON DELETE CASCADE,
                    CONSTRAINT FK_course_requirement_skill_id FOREIGN KEY (skill_id) REFERENCES `skill` (id) ON UPDATE CASCADE ON DELETE CASCADE
                ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE `course_result` (
                    course_id CHAR(36) NOT NULL,
                    skill_id CHAR(36) NOT NULL,
                    INDEX IDX_course_result_course_id (course_id),
                    INDEX IDX_course_result_skill_id (skill_id),
                    CONSTRAINT FK_course_result_course_id FOREIGN KEY (course_id) REFERENCES `course` (id) ON UPDATE CASCADE ON DELETE CASCADE,
                    CONSTRAINT FK_course_result_skill_id FOREIGN KEY (skill_id) REFERENCES `skill` (id) ON UPDATE CASCADE ON DELETE CASCADE
                ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE `lesson` (
                    id CHAR(36) NOT NULL PRIMARY KEY,
                    name VARCHAR(50) NOT NULL,
                    slug VARCHAR(50) NOT NULL,
                    video_provider VARCHAR(20) NOT NULL,
                    video_id VARCHAR(20) NOT NULL,
                    description TEXT NOT NULL,
                    duration SMALLINT UNSIGNED,
                    course_id CHAR(36) NOT NULL,
                    INDEX IDX_lesson_name (name),
                    INDEX IDX_course_id (course_id),
                    CONSTRAINT FK_lesson_course_id FOREIGN KEY (course_id) REFERENCES `course` (id) ON UPDATE CASCADE ON DELETE CASCADE
                ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE `lesson_requirement` (
                    lesson_id CHAR(36) NOT NULL,
                    skill_id CHAR(36) NOT NULL,
                    INDEX IDX_lesson_requirement_course_id (lesson_id),
                    INDEX IDX_lesson_requirement_skill_id (skill_id),
                    CONSTRAINT FK_lesson_requirement_course_id FOREIGN KEY (lesson_id) REFERENCES `lesson` (id) ON UPDATE CASCADE ON DELETE CASCADE,
                    CONSTRAINT FK_lesson_requirement_skill_id FOREIGN KEY (skill_id) REFERENCES `skill` (id) ON UPDATE CASCADE ON DELETE CASCADE
                ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE `lesson_result` (
                    lesson_id CHAR(36) NOT NULL,
                    skill_id CHAR(36) NOT NULL,
                    INDEX IDX_lesson_result_course_id (lesson_id),
                    INDEX IDX_lesson_result_skill_id (skill_id),
                    CONSTRAINT FK_lesson_result_lesson_id FOREIGN KEY (lesson_id) REFERENCES `lesson` (id) ON UPDATE CASCADE ON DELETE CASCADE,
                    CONSTRAINT FK_lesson_result_skill_id FOREIGN KEY (skill_id) REFERENCES `skill` (id) ON UPDATE CASCADE ON DELETE CASCADE
                ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE `course_enrollment` (
                    id CHAR(36) NOT NULL PRIMARY KEY,
                    enrollment_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    user_id CHAR(36) NOT NULL,
                    course_id CHAR(36) NOT NULL,
                    INDEX IDX_course_enrollment_user_id (user_id),
                    INDEX IDX_course_enrollment_course_id (course_id),
                    CONSTRAINT FK_course_enrollment_user_id FOREIGN KEY (user_id) REFERENCES `user` (id) ON UPDATE CASCADE ON DELETE CASCADE,
                    CONSTRAINT FK_course_enrollment_skill_id FOREIGN KEY (course_id) REFERENCES `course` (id) ON UPDATE CASCADE ON DELETE CASCADE
                ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE `course_enrollment_lesson` (
                    course_enrollment_id CHAR(36) NOT NULL,
                    lesson_id CHAR(36) NOT NULL,
                    INDEX IDX_course_enrollment_lesson_course_enrollment_id (course_enrollment_id),
                    INDEX IDX_course_enrollment_lesson_lesson_id (lesson_id),
                    CONSTRAINT FK_course_enrollment_lesson_course_enrollment_id FOREIGN KEY (course_enrollment_id) REFERENCES `course_enrollment` (id) ON UPDATE CASCADE ON DELETE CASCADE,
                    CONSTRAINT FK_course_enrollment_lesson_lesson_id FOREIGN KEY (lesson_id) REFERENCES `lesson` (id) ON UPDATE CASCADE ON DELETE CASCADE
                ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `course_enrollment_lesson`');
        $this->addSql('DROP TABLE `course_enrollment`');
        $this->addSql('DROP TABLE `lesson_result`');
        $this->addSql('DROP TABLE `lesson_requirement`');
        $this->addSql('DROP TABLE `lesson`');
        $this->addSql('DROP TABLE `course_result`');
        $this->addSql('DROP TABLE `course_requirement`');
        $this->addSql('DROP TABLE `course`');
        $this->addSql('DROP TABLE `skill`');
    }
}
