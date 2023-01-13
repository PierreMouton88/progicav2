<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230113153043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gite DROP FOREIGN KEY FK_B638C92CA76ED395');
        $this->addSql('ALTER TABLE gite DROP FOREIGN KEY FK_B638C92CE7A1254A');
        $this->addSql('ALTER TABLE gite ADD CONSTRAINT FK_B638C92CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE SET NULL ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite ADD CONSTRAINT FK_B638C92CE7A1254A FOREIGN KEY (contact_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_eqp_int DROP FOREIGN KEY FK_F18AAA88652CAE9B');
        $this->addSql('ALTER TABLE gite_eqp_int DROP FOREIGN KEY FK_F18AAA883EF5C44D');
        $this->addSql('ALTER TABLE gite_eqp_int ADD CONSTRAINT FK_F18AAA88652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_eqp_int ADD CONSTRAINT FK_F18AAA883EF5C44D FOREIGN KEY (eqp_int_id) REFERENCES eqp_int (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_service DROP FOREIGN KEY FK_1527AE9AED5CA9E6');
        $this->addSql('ALTER TABLE gite_service DROP FOREIGN KEY FK_1527AE9A652CAE9B');
        $this->addSql('ALTER TABLE gite_service ADD CONSTRAINT FK_1527AE9AED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_service ADD CONSTRAINT FK_1527AE9A652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gite DROP FOREIGN KEY FK_B638C92CA76ED395');
        $this->addSql('ALTER TABLE gite DROP FOREIGN KEY FK_B638C92CE7A1254A');
        $this->addSql('ALTER TABLE gite ADD CONSTRAINT FK_B638C92CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE SET NULL ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite ADD CONSTRAINT FK_B638C92CE7A1254A FOREIGN KEY (contact_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_eqp_int DROP FOREIGN KEY FK_F18AAA88652CAE9B');
        $this->addSql('ALTER TABLE gite_eqp_int DROP FOREIGN KEY FK_F18AAA883EF5C44D');
        $this->addSql('ALTER TABLE gite_eqp_int ADD CONSTRAINT FK_F18AAA88652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_eqp_int ADD CONSTRAINT FK_F18AAA883EF5C44D FOREIGN KEY (eqp_int_id) REFERENCES eqp_int (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_service DROP FOREIGN KEY FK_1527AE9AED5CA9E6');
        $this->addSql('ALTER TABLE gite_service DROP FOREIGN KEY FK_1527AE9A652CAE9B');
        $this->addSql('ALTER TABLE gite_service ADD CONSTRAINT FK_1527AE9AED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_service ADD CONSTRAINT FK_1527AE9A652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
