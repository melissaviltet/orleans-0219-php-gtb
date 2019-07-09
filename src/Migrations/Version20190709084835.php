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
        $this->addSql('INSERT INTO user
        (gender_id, email, roles, password, firstname, lastname, address, birthdate, telephone)
        VALUES (1, \'admin@gmail.com\',
            \'["ROLE_ADMIN"]\',
            \'$argon2i$v=19$m=1024,t=2,p=2$d3V4Ukl6VHlIcXJxM0JFNQ$8Jm6/Z96Ebh/G2+f2el4RfxSVdpxYyq5W+N2BZSdbDc\',
            \'admin\', \'trail\', \'1 rue du trail\', \'1990-01-01\', 0000000000);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE TABLE user');
    }
}
