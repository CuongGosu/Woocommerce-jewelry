<?php
                $comments = get_comments([
                                    "post_id"             => get_the_ID(),
                                    "author_email" => "",
                                    "author__in" => "",
                                    "author__not_in" => "",
                                    "include_unapproved" => "",
                                    "fields" => "",
                                    "ID" => "",
                                    "comment__in" => "",
                                    "comment__not_in" => "",
                                    "karma" => "",
                                    "number" => "",
                                    "offset" => "",
                                    "orderby" => "",
                                    "order" => "DESC",
                                    "parent" => "",
                                    "post_author__in" => "",
                                    "post_author__not_in" => "",
                                    "post_ID" => "", // ignored (use post_id instead)
                                    "post__in" => "",
                                    "post__not_in" => "",
                                    "post_author" => "",
                                    "post_name" => "",
                                    "post_parent" => "",
                                    "post_status" => "",
                                    "post_type" => "",
                                    "status" => "all",
                                    "type" => "",
                                    "type__in" => "",
                                    "type__not_in" => "",
                                    "user_id" => "",
                                    "search" => "",
                                    "count" => false,
                                    "meta_key" => "",
                                    "meta_value" => "",
                                    "meta_query" => "",
                                    "date_query" => null, // See WP_Date_Query
                                 ]);
        ?>
        <?php comment_form() ?>