<?php

declare(strict_types=1);

namespace Api\Data\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190511135009 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE video_authors (id CHAR(36) NOT NULL COMMENT \'(DC2Type:video_author_id)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_videos (id CHAR(36) NOT NULL COMMENT \'(DC2Type:video_video_id)\', author_id CHAR(36) NOT NULL COMMENT \'(DC2Type:video_author_id)\', create_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', name VARCHAR(255) NOT NULL, origin VARCHAR(255) NOT NULL, status VARCHAR(16) NOT NULL, publish_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', thumbnail_path VARCHAR(255) DEFAULT NULL, thumbnail_size_width INT DEFAULT NULL, thumbnail_size_height INT DEFAULT NULL, INDEX IDX_11FDC4FFF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_video_files (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', video_id CHAR(36) NOT NULL COMMENT \'(DC2Type:video_video_id)\', path VARCHAR(255) NOT NULL, format VARCHAR(255) NOT NULL, size_width INT DEFAULT NULL, size_height INT DEFAULT NULL, INDEX IDX_ABD5F85A29C1004E (video_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE video_videos ADD CONSTRAINT FK_11FDC4FFF675F31B FOREIGN KEY (author_id) REFERENCES video_authors (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_video_files ADD CONSTRAINT FK_ABD5F85A29C1004E FOREIGN KEY (video_id) REFERENCES video_videos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_users CHANGE email email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE oauth_access_tokens CHANGE client client VARCHAR(255) NOT NULL, CHANGE scopes scopes JSON NOT NULL');
        $this->addSql('ALTER TABLE oauth_auth_codes CHANGE client client VARCHAR(255) NOT NULL, CHANGE scopes scopes JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE video_videos DROP FOREIGN KEY FK_11FDC4FFF675F31B');
        $this->addSql('ALTER TABLE video_video_files DROP FOREIGN KEY FK_ABD5F85A29C1004E');
        $this->addSql('DROP TABLE video_authors');
        $this->addSql('DROP TABLE video_videos');
        $this->addSql('DROP TABLE video_video_files');
        $this->addSql('ALTER TABLE oauth_access_tokens CHANGE client client VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE scopes scopes JSON NOT NULL');
        $this->addSql('ALTER TABLE oauth_auth_codes CHANGE client client VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE scopes scopes JSON NOT NULL');
        $this->addSql('ALTER TABLE user_users CHANGE email email VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
