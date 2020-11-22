<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Model\User;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201031101925 extends AbstractMigration implements ContainerAwareInterface
{

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $password = $this->container->get('security.password_encoder')->encodePassword(new User(), 'password');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, phone VARCHAR(20) DEFAULT NULL, email VARCHAR(255) NOT NULL, message TEXT NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE education (id INT AUTO_INCREMENT NOT NULL, school VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, start DATE NOT NULL, end DATE DEFAULT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, company VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, start DATE NOT NULL, end DATE DEFAULT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, rate SMALLINT NOT NULL, position SMALLINT NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE config (id INT AUTO_INCREMENT NOT NULL, `key` VARCHAR(255) NOT NULL, value LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql("INSERT INTO config (`key`, value, type) VALUES ('seo_title', 'John Doe - Software Engineer', 'string')");
        $this->addSql("INSERT INTO config (`key`, value, type) VALUES ('seo_description', 'John Doe, Software Engineer, Php, Docker', 'text')");
        $this->addSql("INSERT INTO config (`key`, value, type) VALUES ('seo_keywords', 'Software Engineer', 'string')");
        $this->addSql("INSERT INTO config (`key`, value, type) VALUES ('seo_author', 'John Doe', 'string')");
        $this->addSql("INSERT INTO config (`key`, value, type) VALUES ('index_firstname', 'John', 'string')");
        $this->addSql("INSERT INTO config (`key`, value, type) VALUES ('index_lastname', 'Doe', 'string')");
        $this->addSql("INSERT INTO config (`key`, value, type) VALUES ('index_description', 'Decennium vidisse aliquem advena honestus non et non coactusque ob.', 'text')");
        $this->addSql("INSERT INTO config (`key`, value, type) VALUES ('index_interests', 'Protectoribus in lenitatem propensior addensque quo id adlocutus tunc mandaverat.', 'text')");
        $this->addSql("INSERT INTO config (`key`, value, type) VALUES ('links_linkedin', 'https://www.linkedin.com', 'link')");
        $this->addSql("INSERT INTO config (`key`, value, type) VALUES ('links_github', 'https://www.github.com', 'link')");
        $this->addSql("INSERT INTO config (`key`, value, type) VALUES ('login_email', 'john.doe@email.email', 'email')");
        $this->addSql("INSERT INTO config (`key`, value, type) VALUES ('login_password', '$password', 'password')");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE education');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE config');
    }
}
