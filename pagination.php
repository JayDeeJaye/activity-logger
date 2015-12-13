<?php
    // This function builds pagination links based on the current page and the number of pages
    function generate_page_links($cur_page, $num_pages) {
        $page_links = '';

        // If this page is not the first page, generate the "previous" link
        if ($cur_page > 1) {
            $page_links .= '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($cur_page - 1) . '"><-</a> ';
        } else {
            $page_links .= '<- ';
        }

        // Loop through the pages generating the page number links
        for ($i = 1; $i <= $num_pages; $i++) {
            if ($cur_page == $i) {
                $page_links .= ' ' . $i;
            } else {
                $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?page=' . $i . '"> ' . $i . '</a>';
            }
        }

        // If this page is not the last page, generate the "next" link
        if ($cur_page < $num_pages) {
            $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($cur_page + 1) . '">-></a>';
        } else {
            $page_links .= ' ->';
        }

        return $page_links;
    }
?>

