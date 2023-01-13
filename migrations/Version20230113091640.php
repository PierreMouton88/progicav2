<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230113091640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE eqp_int (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gite_eqp_ext (id INT AUTO_INCREMENT NOT NULL, gite_id INT DEFAULT NULL, eqp_ext_id INT DEFAULT NULL, INDEX IDX_E408E63B652CAE9B (gite_id), INDEX IDX_E408E63BA6976614 (eqp_ext_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gite_eqp_int (id INT AUTO_INCREMENT NOT NULL, gite_id INT DEFAULT NULL, eqp_int_id INT DEFAULT NULL, INDEX IDX_F18AAA88652CAE9B (gite_id), INDEX IDX_F18AAA883EF5C44D (eqp_int_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gite_eqp_ext ADD CONSTRAINT FK_E408E63B652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id)');
        $this->addSql('ALTER TABLE gite_eqp_ext ADD CONSTRAINT FK_E408E63BA6976614 FOREIGN KEY (eqp_ext_id) REFERENCES eqp_ext (id)');
        $this->addSql('ALTER TABLE gite_eqp_int ADD CONSTRAINT FK_F18AAA88652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id)');
        $this->addSql('ALTER TABLE gite_eqp_int ADD CONSTRAINT FK_F18AAA883EF5C44D FOREIGN KEY (eqp_int_id) REFERENCES eqp_int (id)');
        $this->addSql('ALTER TABLE eqp_ext ADD name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gite_eqp_ext DROP FOREIGN KEY FK_E408E63B652CAE9B');
        $this->addSql('ALTER TABLE gite_eqp_ext DROP FOREIGN KEY FK_E408E63BA6976614');
        $this->addSql('ALTER TABLE gite_eqp_int DROP FOREIGN KEY FK_F18AAA88652CAE9B');
        $this->addSql('ALTER TABLE gite_eqp_int DROP FOREIGN KEY FK_F18AAA883EF5C44D');
        $this->addSql('DROP TABLE eqp_int');
        $this->addSql('DROP TABLE gite_eqp_ext');
        $this->addSql('DROP TABLE gite_eqp_int');
        $this->addSql('ALTER TABLE eqp_ext DROP name');
    }
}
