<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230118103921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE eqp (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eqp_gite (eqp_id INT NOT NULL, gite_id INT NOT NULL, INDEX IDX_912BE9C2DF764A8B (eqp_id), INDEX IDX_912BE9C2652CAE9B (gite_id), PRIMARY KEY(eqp_id, gite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eqp_gite ADD CONSTRAINT FK_912BE9C2DF764A8B FOREIGN KEY (eqp_id) REFERENCES eqp (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eqp_gite ADD CONSTRAINT FK_912BE9C2652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eqp_gite DROP FOREIGN KEY FK_912BE9C2DF764A8B');
        $this->addSql('ALTER TABLE eqp_gite DROP FOREIGN KEY FK_912BE9C2652CAE9B');
        $this->addSql('DROP TABLE eqp');
        $this->addSql('DROP TABLE eqp_gite');
    }
}
