<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240501204249 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE allergie_produit DROP FOREIGN KEY allergie_produit_ibfk_1');
        $this->addSql('ALTER TABLE allergie_produit DROP FOREIGN KEY allergie_produit_ibfk_2');
        $this->addSql('DROP INDEX allergie_id ON allergie_produit');
        $this->addSql('CREATE INDEX IDX_7BFA69BF7C86304A ON allergie_produit (allergie_id)');
        $this->addSql('DROP INDEX produit_id ON allergie_produit');
        $this->addSql('CREATE INDEX IDX_7BFA69BFF347EFB ON allergie_produit (produit_id)');
        $this->addSql('ALTER TABLE allergie_produit ADD CONSTRAINT allergie_produit_ibfk_1 FOREIGN KEY (allergie_id) REFERENCES allergie (id)');
        $this->addSql('ALTER TABLE allergie_produit ADD CONSTRAINT allergie_produit_ibfk_2 FOREIGN KEY (produit_id) REFERENCES produit (id_produit)');
        $this->addSql('ALTER TABLE produit_panier DROP FOREIGN KEY produit_panier_ibfk_2');
        $this->addSql('DROP INDEX id_panier ON produit_panier');
        $this->addSql('CREATE INDEX IDX_D39EC6C87ED05DDC ON produit_panier (ID_Panier)');
        $this->addSql('ALTER TABLE produit_panier ADD CONSTRAINT produit_panier_ibfk_2 FOREIGN KEY (ID_Panier) REFERENCES panier (id_panier)');
        $this->addSql('ALTER TABLE user CHANGE isbanned isbanned TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE panier_user DROP FOREIGN KEY panier_user_ibfk_2');
        $this->addSql('DROP INDEX id_panier ON panier_user');
        $this->addSql('CREATE INDEX IDX_7975F3307ED05DDC ON panier_user (ID_Panier)');
        $this->addSql('ALTER TABLE panier_user ADD CONSTRAINT panier_user_ibfk_2 FOREIGN KEY (ID_Panier) REFERENCES panier (id_panier)');
        $this->addSql('DROP INDEX `primary` ON user_allergie');
        $this->addSql('ALTER TABLE user_allergie ADD PRIMARY KEY (allergie_id, user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE allergie_produit DROP FOREIGN KEY FK_7BFA69BF7C86304A');
        $this->addSql('ALTER TABLE allergie_produit DROP FOREIGN KEY FK_7BFA69BFF347EFB');
        $this->addSql('DROP INDEX idx_7bfa69bf7c86304a ON allergie_produit');
        $this->addSql('CREATE INDEX allergie_id ON allergie_produit (allergie_id)');
        $this->addSql('DROP INDEX idx_7bfa69bff347efb ON allergie_produit');
        $this->addSql('CREATE INDEX produit_id ON allergie_produit (produit_id)');
        $this->addSql('ALTER TABLE allergie_produit ADD CONSTRAINT FK_7BFA69BF7C86304A FOREIGN KEY (allergie_id) REFERENCES allergie (id)');
        $this->addSql('ALTER TABLE allergie_produit ADD CONSTRAINT FK_7BFA69BFF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id_produit)');
        $this->addSql('ALTER TABLE panier_user DROP FOREIGN KEY FK_7975F3307ED05DDC');
        $this->addSql('DROP INDEX idx_7975f3307ed05ddc ON panier_user');
        $this->addSql('CREATE INDEX ID_Panier ON panier_user (ID_Panier)');
        $this->addSql('ALTER TABLE panier_user ADD CONSTRAINT FK_7975F3307ED05DDC FOREIGN KEY (ID_Panier) REFERENCES panier (id_panier)');
        $this->addSql('ALTER TABLE produit_panier DROP FOREIGN KEY FK_D39EC6C87ED05DDC');
        $this->addSql('DROP INDEX idx_d39ec6c87ed05ddc ON produit_panier');
        $this->addSql('CREATE INDEX ID_Panier ON produit_panier (ID_Panier)');
        $this->addSql('ALTER TABLE produit_panier ADD CONSTRAINT FK_D39EC6C87ED05DDC FOREIGN KEY (ID_Panier) REFERENCES panier (id_panier)');
        $this->addSql('ALTER TABLE user CHANGE isbanned isbanned TINYINT(1) DEFAULT 0');
        $this->addSql('DROP INDEX `PRIMARY` ON user_allergie');
        $this->addSql('ALTER TABLE user_allergie ADD PRIMARY KEY (user_id, allergie_id)');
    }
}
