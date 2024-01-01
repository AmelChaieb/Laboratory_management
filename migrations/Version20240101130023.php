<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240101130023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chercheur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, chercheur_id INT DEFAULT NULL, projet_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, disponible TINYINT(1) NOT NULL, INDEX IDX_B8B4C6F3F0950B34 (chercheur_id), INDEX IDX_B8B4C6F3C18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chercheur_projet (projet_id INT NOT NULL, chercheur_id INT NOT NULL, INDEX IDX_414D615DC18272 (projet_id), INDEX IDX_414D615DF0950B34 (chercheur_id), PRIMARY KEY(projet_id, chercheur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publication (id INT AUTO_INCREMENT NOT NULL, projet_id INT NOT NULL, INDEX IDX_AF3C6779C18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F3F0950B34 FOREIGN KEY (chercheur_id) REFERENCES chercheur (id)');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F3C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE chercheur_projet ADD CONSTRAINT FK_414D615DC18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chercheur_projet ADD CONSTRAINT FK_414D615DF0950B34 FOREIGN KEY (chercheur_id) REFERENCES chercheur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C6779C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F3F0950B34');
        $this->addSql('ALTER TABLE chercheur_projet DROP FOREIGN KEY FK_414D615DF0950B34');
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F3C18272');
        $this->addSql('ALTER TABLE chercheur_projet DROP FOREIGN KEY FK_414D615DC18272');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C6779C18272');
        $this->addSql('DROP TABLE chercheur');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE chercheur_projet');
        $this->addSql('DROP TABLE publication');
    }
}
