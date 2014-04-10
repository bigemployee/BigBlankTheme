<?php
/**
 * Template Name: Forms
 * This template is used for testing purpose only, to demo form styles
 *
 */
get_header();
?>
<div id="forms" class="site-content">
    <div id="main" role="main">
        <?php while (have_posts()) : the_post(); ?>
            <article id="content" <?php post_class(); ?>>
                <?php
                // Page thumbnail and title.
                bigblank_post_thumbnail();
                the_title('<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->');
                ?>
                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php edit_post_link(__('Edit', 'bigblank')); ?>
                    <p class="alert alert-success">
                        <strong>Well done!</strong> You successfully read <a href="#" class="">this important alert message</a>.
                    </p>
                    <p class="alert alert-info">
                        <strong>Heads up!</strong> This <a href="#" class="">alert needs your attention</a>, but it's not super important.
                    </p>
                    <p class="alert alert-warning">
                        <strong>Warning!</strong> Better check yourself, you're <a href="#" class="">not looking too good</a>.
                    </p>
                    <p class="alert alert-danger">
                        <strong>Oh snap!</strong> <a href="#" class="">Change a few things up</a> and try submitting again.
                    </p>
                    <form role="form">
                        <div class="form-group">
                            <label for="exampleInputText">Input <small>(type="text")</small></label>
                            <input type="text" class="form-control" id="exampleInputText" placeholder="Write Something" value="This is some text as value">
                            <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>
                        </div>
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
                        <div class="form-group">
                            <label for="selectInput">Select Something</label>
                            <select id="selectInput" class="form-control">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="selectMultiInput">Select Multiple</label>
                            <select multiple id="selectMultiInput" class="form-control">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <textarea class="form-control" rows="3"></textarea>
                        <button type="submit" class="button fa-angle-right">Submit</button>
                        <fieldset disabled>
                            <div class="form-group">
                                <label for="disabledTextInput">Disabled input</label>
                                <input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input">
                            </div>
                            <div class="form-group">
                                <label for="disabledSelect">Disabled select menu</label>
                                <select id="disabledSelect" class="form-control" disabled="disabled" >
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
                        <div class="form-group">
                            <label for="exampleInputText3">Input <small>(type="text")</small></label>
                            <input type="text" class="form-control" id="exampleInputText3" placeholder="Write Something" value="This is a disabled text field" disabled="dsiabled">
                        </div>
                        <button type="submit" class="button fa-angle-right" disabled="disabled">Disabled Submit</button>
                        <input type="submit" class="button" value="Disabled Input" disabled="dsiabled">
                        <a href="#" class="button disabled" role="button">Disabled Link Button</a>
                    </form>
                </div><!-- .entry-content -->
            </article><!-- #content -->
        <?php endwhile; ?>
    </div><!-- #main -->
</div><!-- #forms -->
<?php
get_footer();
