<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190709084835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {

        $this->addSql('INSERT INTO activity (name) VALUES (\'Trail\'),(\'Triathlon\'),(\'Préparation physique\'),
        (\'natation\'),(\'cyclisme\'),(\'natation\');');
    }


    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE TABLE user');
    }
}
