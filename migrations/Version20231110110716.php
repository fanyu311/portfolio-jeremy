<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231110110716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE portfolio_categorie (portfolio_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_B7D54718B96B5643 (portfolio_id), INDEX IDX_B7D54718BCF5E72D (categorie_id), PRIMARY KEY(portfolio_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE portfolio_categorie ADD CONSTRAINT FK_B7D54718B96B5643 FOREIGN KEY (portfolio_id) REFERENCES portfolio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE portfolio_categorie ADD CONSTRAINT FK_B7D54718BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_portfolio DROP FOREIGN KEY FK_4B21F65B96B5643');
        $this->addSql('ALTER TABLE categorie_portfolio DROP FOREIGN KEY FK_4B21F65BCF5E72D');
        $this->addSql('DROP TABLE categorie_portfolio');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_portfolio (categorie_id INT NOT NULL, portfolio_id INT NOT NULL, INDEX IDX_4B21F65B96B5643 (portfolio_id), INDEX IDX_4B21F65BCF5E72D (categorie_id), PRIMARY KEY(categorie_id, portfolio_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE categorie_portfolio ADD CONSTRAINT FK_4B21F65B96B5643 FOREIGN KEY (portfolio_id) REFERENCES portfolio (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_portfolio ADD CONSTRAINT FK_4B21F65BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE portfolio_categorie DROP FOREIGN KEY FK_B7D54718B96B5643');
        $this->addSql('ALTER TABLE portfolio_categorie DROP FOREIGN KEY FK_B7D54718BCF5E72D');
        $this->addSql('DROP TABLE portfolio_categorie');
    }
}
