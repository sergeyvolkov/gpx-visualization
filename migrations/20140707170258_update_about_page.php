<?php

use Phinx\Migration\AbstractMigration;

class UpdateAboutPage extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
    public function change()
    {
    }
    */
    
    /**
     * Migrate Up.
     */
    public function up()
    {
        $this->query('DELETE FROM pages');

        $this->query('
            INSERT INTO pages (title, alias, content, keywords, description, updated, userId) VALUES
            (
              "About Tracks",
              "about",
              "Import your GPX tracks and view a visualization. <br>
                Follow me: <br>

                <!-- start icons -->
                <div>
                <iframe src=\"http://ghbtns.com/github-btn.html?user=sergeyvolkov&repo=gpx-visualization&type=watch\" allowtransparency=\"true\" frameborder=\"0\" scrolling=\"0\" width=\"52\" height=\"20\"></iframe>
                <iframe src=\"http://ghbtns.com/github-btn.html?user=sergeyvolkov&repo=gpx-visualization&type=fork\" allowtransparency=\"true\" frameborder=\"0\" scrolling=\"0\" width=\"62\" height=\"20\"></iframe>
                <iframe src=\"http://ghbtns.com/github-btn.html?user=sergeyvolkov&repo=gpx-visualization&type=follow\" allowtransparency=\"true\" frameborder=\"0\" scrolling=\"0\" width=\"182\" height=\"20\"></iframe>
                <iframe src=\"http://ghbtns.com/github-btn.html?user=sergeyvolkov&repo=gpx-visualization&type=watch&count=true\" allowtransparency=\"true\" frameborder=\"0\" scrolling=\"0\" width=\"65\" height=\"20\"></iframe>
                <iframe src=\"http://ghbtns.com/github-btn.html?user=sergeyvolkov&repo=gpx-visualization&type=fork&count=true\" allowtransparency=\"true\" frameborder=\"0\" scrolling=\"0\" width=\"65\" height=\"20\"></iframe>
                <iframe src=\"http://ghbtns.com/github-btn.html?user=sergeyvolkov&repo=gpx-visualization&type=follow&count=true\" allowtransparency=\"true\" frameborder=\"0\" scrolling=\"0\" width=\"250\" height=\"20\"></iframe>
                </div>
                <!-- end icons -->",
              "GPX, tracks, Bluz framework",
              "Tracks - visualize your GPX",
              CURRENT_TIMESTAMP,
              1
            )
        ');
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->query('DELETE FROM pages');

        $this->query('
            INSERT INTO pages (title, alias, content, keywords, description, updated, userId) VALUES
            (
              "About Bluz Framework",
              "about",
              "<p>Bluz Lightweight PHP Framework!</p>",
              "about bluz framework",
              "About Bluz",
              CURRENT_TIMESTAMP,
              0
            )
        ');
    }
}