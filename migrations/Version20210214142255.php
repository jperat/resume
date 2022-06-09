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
final class Version20210214142255 extends AbstractMigration implements ContainerAwareInterface
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

        $this->addSql("INSERT INTO config (`key`, value, type) VALUES ('color_primary', '#BD5D38', 'string')");
        $this->addSql("INSERT INTO config (`key`, value, type) VALUES ('color_secondary', '#BD5D38', 'string')");
        $this->addSql("INSERT INTO config (`key`, value, type) VALUES ('color_social_hover', '#BD5D38', 'string')");
        $this->addSql("INSERT INTO config (`key`, value, type) VALUES ('border_circle', '0.5rem solid rgba(255, 255, 255, 0.2)', 'string')");
        $this->addSql("INSERT INTO config (`key`, value, type) VALUES ('skill_icons', 'java,php,symfony,js,html5,css3-alt,python,docker,vuejs', 'string')");
        $this->addSql("INSERT INTO config (`key`, value, type) VALUES ('locale', 'en', 'string')");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("DELETE FROM config WHERE `key` IN ('color_primary', 'color_secondary', 'border_circle', 'skill_icons', 'color_social_hover', 'locale')");
    }
}
