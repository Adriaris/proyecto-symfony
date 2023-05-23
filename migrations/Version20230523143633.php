<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523143633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_characters (user_id INT NOT NULL, character_id INT NOT NULL, INDEX IDX_9D4E87E2A76ED395 (user_id), INDEX IDX_9D4E87E21136BE75 (character_id), PRIMARY KEY(user_id, character_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_characters ADD CONSTRAINT FK_9D4E87E2A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_characters ADD CONSTRAINT FK_9D4E87E21136BE75 FOREIGN KEY (character_id) REFERENCES characters (id_character)');
        $this->addSql('ALTER TABLE ambitions CHANGE id_ambition id_ambition INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE availabilities CHANGE id_availability id_availability INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY messages_ibfk_1');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY messages_ibfk_2');
        $this->addSql('ALTER TABLE messages CHANGE message message LONGTEXT NOT NULL, CHANGE sent_at sent_at DATETIME NOT NULL');
        $this->addSql('DROP INDEX sender_id ON messages');
        $this->addSql('CREATE INDEX IDX_DB021E96F624B39D ON messages (sender_id)');
        $this->addSql('DROP INDEX receiver_id ON messages');
        $this->addSql('CREATE INDEX IDX_DB021E96CD53EDB6 ON messages (receiver_id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT messages_ibfk_1 FOREIGN KEY (sender_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT messages_ibfk_2 FOREIGN KEY (receiver_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE solo_roles CHANGE id_srole id_srole INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE team_roles CHANGE id_trole id_trole INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE id_availability id_availability INT DEFAULT NULL, CHANGE id_first_character id_first_character INT DEFAULT NULL, CHANGE id_second_character id_second_character INT DEFAULT NULL, CHANGE id_third_character id_third_character INT DEFAULT NULL, CHANGE id_ambition id_ambition INT DEFAULT NULL, CHANGE id_srole id_srole INT DEFAULT NULL, CHANGE id_trole id_trole INT DEFAULT NULL, CHANGE id_rank id_rank INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_characters DROP FOREIGN KEY FK_9D4E87E2A76ED395');
        $this->addSql('ALTER TABLE user_characters DROP FOREIGN KEY FK_9D4E87E21136BE75');
        $this->addSql('DROP TABLE user_characters');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE ambitions CHANGE id_ambition id_ambition INT NOT NULL');
        $this->addSql('ALTER TABLE availabilities CHANGE id_availability id_availability INT NOT NULL');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96F624B39D');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96CD53EDB6');
        $this->addSql('ALTER TABLE messages CHANGE message message TEXT NOT NULL, CHANGE sent_at sent_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('DROP INDEX idx_db021e96cd53edb6 ON messages');
        $this->addSql('CREATE INDEX receiver_id ON messages (receiver_id)');
        $this->addSql('DROP INDEX idx_db021e96f624b39d ON messages');
        $this->addSql('CREATE INDEX sender_id ON messages (sender_id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96F624B39D FOREIGN KEY (sender_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96CD53EDB6 FOREIGN KEY (receiver_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE solo_roles CHANGE id_srole id_srole INT NOT NULL');
        $this->addSql('ALTER TABLE team_roles CHANGE id_trole id_trole INT NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE id_rank id_rank INT NOT NULL, CHANGE id_ambition id_ambition INT NOT NULL, CHANGE id_second_character id_second_character INT NOT NULL, CHANGE id_srole id_srole INT NOT NULL, CHANGE id_availability id_availability INT NOT NULL, CHANGE id_third_character id_third_character INT NOT NULL, CHANGE id_trole id_trole INT NOT NULL, CHANGE id_first_character id_first_character INT NOT NULL');
    }
}
