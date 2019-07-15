<?php declare(strict_types=1);

namespace App\Entity\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190715025314 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE relays (id INT AUTO_INCREMENT NOT NULL, base_url VARCHAR(255) DEFAULT NULL, name VARCHAR(100) DEFAULT NULL, nowplaying LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', created_at INT NOT NULL, updated_at INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE station_remotes ADD relay_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE station_remotes ADD CONSTRAINT FK_779D0E8A68A482E FOREIGN KEY (relay_id) REFERENCES relays (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_779D0E8A68A482E ON station_remotes (relay_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE station_remotes DROP FOREIGN KEY FK_779D0E8A68A482E');
        $this->addSql('DROP TABLE relays');
        $this->addSql('DROP INDEX IDX_779D0E8A68A482E ON station_remotes');
        $this->addSql('ALTER TABLE station_remotes DROP relay_id');
    }
}
