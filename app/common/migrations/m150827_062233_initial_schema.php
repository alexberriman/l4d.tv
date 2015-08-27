<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Class m150827_062233_initial_schema
 */
class m150827_062233_initial_schema extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        // Video source table
        $this->createTable('{{%video_source}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'desc' => Schema::TYPE_STRING . ' NOT NULL',
            'priority' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'logo' => Schema::TYPE_STRING,
        ], $tableOptions);

        // Video table
        $this->createTable('{{%video}}', [
            'id' => Schema::TYPE_PK,
            'video_source_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT,
            '`key`' => Schema::TYPE_STRING . ' NOT NULL',
            'thumbnail' => Schema::TYPE_STRING,
            'date_added' => Schema::TYPE_DATETIME . ' NOT NULL',
            'date_created' => Schema::TYPE_DATE,
            'added_by_id' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->addForeignKey('video_video_source_fk', '{{%video}}', 'video_source_id', '{{%video_source}}', 'id',
            'CASCADE');
        $this->addForeignKey('video_user_fk', '{{%video}}', 'added_by_id', '{{%user}}', 'id', 'SET NULL');

        // Country table
        $this->createTable('{{%country}}', [
            'id' => Schema::TYPE_STRING . '(2) NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'thumbnail' => Schema::TYPE_STRING,
            'PRIMARY KEY(`id`)',
        ], $tableOptions);

        // Region table
        $this->createTable('{{%region}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'thumbnail' => Schema::TYPE_STRING,
        ], $tableOptions);

        // Country region table
        $this->createTable('{{%country_region}}', [
            'country_id' => Schema::TYPE_STRING . ' NOT NULL',
            'region_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'PRIMARY KEY(`country_id`,`region_id`)',
        ], $tableOptions);

        // Player table
        $this->createTable('{{%player}}', [
            'id' => Schema::TYPE_STRING . '(20) NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'country_id' => Schema::TYPE_STRING,
            'PRIMARY KEY(`id`)',
        ], $tableOptions);

        $this->addForeignKey('player_country_fk', '{{%player}}', 'country_id', '{{%country}}', 'id', 'SET NULL');

        // Team table
        $this->createTable('{{%team}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'logo' => Schema::TYPE_STRING,
            'added_by_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->addForeignKey('team_user_added_by_fk', '{{%team}}', 'added_by_id', '{{%user}}', 'id', 'CASCADE');

        // Team player
        $this->createTable('{{%team_player}}', [
            'team_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'player_id' => Schema::TYPE_STRING . '(20) NOT NULL',
            'status' => Schema::TYPE_INTEGER . '(1) NOT NULL DEFAULT 1',
            'PRIMARY KEY(`team_id`,`player_id`)',
        ], $tableOptions);

        $this->addForeignKey('team_player_team_fk', '{{%team_player}}', 'team_id', '{{%team}}', 'id', 'CASCADE');
        $this->addForeignKey('team_play_player_fk', '{{%team_player}}', 'player_id', '{{%player}}', 'id', 'CASCADE');

        // Caster
        $this->createTable('{{%caster}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);

        // Tournament
        $this->createTable('{{%tournament}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'date' => Schema::TYPE_DATE,
            'country_id' => Schema::TYPE_STRING . '(2)',
            'winning_team_id' => Schema::TYPE_INTEGER,
            'runner_up_id' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->addForeignKey('tournament_country_fk', '{{%tournament}}', 'country_id', '{{%country}}', 'id',
            'SET NULL');
        $this->addForeignKey('tournament_team_winning_team_fk', '{{%tournament}}', 'winning_team_id', '{{%team}}', 'id',
            'SET NULL');
        $this->addForeignKey('tournament_team_runner_up_fk', '{{%tournament}}', 'runner_up_id', '{{%team}}', 'id',
            'SET NULL');

        // Campaign
        $this->createTable('{{%campaign}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'thumbnail' => Schema::TYPE_STRING,
        ], $tableOptions);

        // Video team
        $this->createTable('{{%video_team}}', [
            'video_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'team_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'win' => Schema::TYPE_INTEGER . '(1) DEFAULT 0',
            'PRIMARY KEY(`video_id`,`team_id`)',
        ], $tableOptions);

        $this->addForeignKey('video_team_video_fk', '{{%video_team}}', 'video_id', '{{%video}}', 'id', 'CASCADE');
        $this->addForeignKey('video_team_team_fk', '{{%video_team}}', 'team_id', '{{%team}}', 'id', 'CASCADE');

        // Video player
        $this->createTable('{{%video_player}}', [
            'video_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'player_id' => Schema::TYPE_STRING . '(20) NOT NULL',
            'PRIMARY KEY(`video_id`,`player_id`)',
        ], $tableOptions);

        $this->addForeignKey('video_player_video_fk', '{{%video_player}}', 'video_id', '{{%video}}', 'id', 'CASCADE');
        $this->addForeignKey('video_player_player_fk', '{{%video_player}}', 'player_id', '{{%player}}', 'id',
            'CASCADE');

        // Video caster
        $this->createTable('{{%video_caster}}', [
            'video_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'caster_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'PRIMARY KEY(`video_id`,`caster_id`)',
        ], $tableOptions);

        $this->addForeignKey('video_caster_video_fk', '{{%video_caster}}', 'video_id', '{{%video}}', 'id', 'CASCADE');
        $this->addForeignKey('video_caster_caster_fk', '{{%video_caster}}', 'caster_id', '{{%caster}}', 'id',
            'CASCADE');

        // Video campaign
        $this->createTable('{{%video_campaign}}', [
            'video_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'campaign_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'PRIMARY KEY(`video_id`,`campaign_id`)',
        ], $tableOptions);

        $this->addForeignKey('video_campaign_video_fk', '{{%video_campaign}}', 'video_id', '{{%video}}', 'id',
            'CASCADE');
        $this->addForeignKey('video_campaign_campaign_fk', '{{%video_campaign}}', 'campaign_id', '{{%campaign}}', 'id',
            'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%video_campaign');
        $this->dropTable('{{%video_caster');
        $this->dropTable('{{%video_player');
        $this->dropTable('{{%video_team');
        $this->dropTable('{{%campaign');
        $this->dropTable('{{%tournament');
        $this->dropTable('{{%caster');
        $this->dropTable('{{%team_player');
        $this->dropTable('{{%team');
        $this->dropTable('{{%player');
        $this->dropTable('{{%country_region');
        $this->dropTable('{{%region');
        $this->dropTable('{{%country');
        $this->dropTable('{{%video');
        $this->dropTable('{{%video_source');
    }
}
