<?php
/**
 * Template Name: Forms
 *
 */
get_header();
?>
<div id="home" class="site-content">
    <div id="main" role="main">
        <?php while (have_posts()) : the_post(); ?>
            <article id="home-content" <?php post_class(); ?>>
                <?php
                // Page thumbnail and title.
                bigblank_post_thumbnail();
                the_title('<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->');
                ?>
                <div class="entry-content">
                    <?php the_content(); ?>
                    <form role="form">
                        <div class="form-group">
                            <label for="exampleInputText">Input <small>(type="text")</small></label>
                            <input type="text" class="form-control" id="exampleInputText" placeholder="Write Something">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="file" id="exampleInputFile">
                            <p class="help-block">Example block-level help text here.</p>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Check me out
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="">
                                Option one is this and that&mdash;be sure to include why it's great
                            </label>
                        </div>

                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                Option one is this and that&mdash;be sure to include why it's great
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                Option two can be something else and selecting it will deselect option one
                            </label>
                        </div>
                        <select class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>

                        <select multiple class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                        <input class="form-control" id="disabledInput" type="text" placeholder="Disabled input here..." disabled>
                        <fieldset disabled>
                            <div class="form-group">
                                <label for="disabledTextInput">Disabled input</label>
                                <input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input">
                            </div>
                            <div class="form-group">
                                <label for="disabledSelect">Disabled select menu</label>
                                <select id="disabledSelect" class="form-control">
                                    <option>Disabled select</option>
                                </select>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Can't check this
                                </label>
                            </div>
                            <button type="submit" class="button button-primary">Submit</button>
                        </fieldset>
                        <textarea class="form-control" rows="3"></textarea>
                        <button type="submit" class="button button-default">Submit</button>
                        <a href="#" class="button button-primary button-lg disabled" role="button">Primary link</a>
                        <a href="#" class="button button-default button-lg disabled" role="button">Link</a>
                    </form>
                </div><!-- .entry-content -->
            </article><!-- #home -->
        <?php endwhile; ?>
    </div><!-- #main -->
</div><!-- #home -->
<?php
get_footer();
