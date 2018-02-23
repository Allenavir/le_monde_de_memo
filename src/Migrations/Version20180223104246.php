<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180223104246 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE memo (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, auteur VARCHAR(255) DEFAULT NULL, genre VARCHAR(255) DEFAULT NULL, acteurs VARCHAR(255) DEFAULT NULL, date DATE NOT NULL, lien_info VARCHAR(255) DEFAULT NULL, lien_stream VARCHAR(255) DEFAULT NULL, lien_choix VARCHAR(255) DEFAULT NULL, supplement LONGTEXT DEFAULT NULL, INDEX IDX_AB4A902AFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(100) NOT NULL, password VARCHAR(100) NOT NULL, mail VARCHAR(255) NOT NULL, role VARCHAR(25) NOT NULL, is_active TINYINT(1) NOT NULL, memo INT DEFAULT NULL, UNIQUE INDEX UNIQ_1D1C63B35126AC48 (mail), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE memo ADD CONSTRAINT FK_AB4A902AFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE memo DROP FOREIGN KEY FK_AB4A902AFB88E14F');
        $this->addSql('DROP TABLE memo');
        $this->addSql('DROP TABLE utilisateur');
    }
}
