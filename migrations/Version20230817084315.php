<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230817084315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE portfolio DROP image');
        $this->addSql('ALTER TABLE portfolio_image ADD portfolio_id INT NOT NULL');
        $this->addSql('ALTER TABLE portfolio_image ADD CONSTRAINT FK_98652E1AB96B5643 FOREIGN KEY (portfolio_id) REFERENCES portfolio (id)');
        $this->addSql('CREATE INDEX IDX_98652E1AB96B5643 ON portfolio_image (portfolio_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE portfolio ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE portfolio_image DROP FOREIGN KEY FK_98652E1AB96B5643');
        $this->addSql('DROP INDEX IDX_98652E1AB96B5643 ON portfolio_image');
        $this->addSql('ALTER TABLE portfolio_image DROP portfolio_id');
    }
}
