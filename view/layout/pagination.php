<?php
function generatePagination($currentPage, $totalPages, $perPage) {
    $pagination = "";
    if ($totalPages > 1) {
        // Start pagination structure
        $pagination .= "<nav aria-label='Page navigation example'>";
        $pagination .= "<ul class='pagination'>";

        // Previous button
        if ($currentPage > 1) {
            $pagination .= "<li class='page-item'><a class='page-link' href='?page=" . ($currentPage - 1) . "&perPage=$perPage'>Previous</a></li>";
        } else {
            $pagination .= "<li class='page-item disabled'><a class='page-link' href='#'>Previous</a></li>";
        }

        // Determine the range of page numbers to show
        $start = max(1, $currentPage - 1); // One page before current
        $end = min($totalPages, $currentPage + 1); // One page after current

        // Show "1 ..." if the range does not include the first page
        if ($start > 1) {
            $pagination .= "<li class='page-item'><a class='page-link' href='?page=1&perPage=$perPage'>1</a></li>";
            if ($start > 2) {
                $pagination .= "<li class='page-item disabled'><a class='page-link' href='#'>...</a></li>";
            }
        }

        // Generate page numbers
        for ($i = $start; $i <= $end; $i++) {
            $activeClass = ($currentPage == $i) ? "active" : "";
            $pagination .= "<li class='page-item $activeClass'><a class='page-link' href='?page=$i&perPage=$perPage'>$i</a></li>";
        }

        // Show "... n" if the range does not include the last page
        if ($end < $totalPages) {
            if ($end < $totalPages - 1) {
                $pagination .= "<li class='page-item disabled'><a class='page-link' href='#'>...</a></li>";
            }
            $pagination .= "<li class='page-item'><a class='page-link' href='?page=$totalPages&perPage=$perPage'>$totalPages</a></li>";
        }

        // Next button
        if ($currentPage < $totalPages) {
            $pagination .= "<li class='page-item'><a class='page-link' href='?page=" . ($currentPage + 1) . "&perPage=$perPage'>Next</a></li>";
        } else {
            $pagination .= "<li class='page-item disabled'><a class='page-link' href='#'>Next</a></li>";
        }

        // Close pagination structure
        $pagination .= "</ul>";
        $pagination .= "</nav>";
    }

    return $pagination;
}

function generatePageSelector($perPage) {
    $queryParams = $_GET; // Get current query parameters
    unset($queryParams['perPage']); // Remove existing perPage to avoid duplicates

    $pagination = "<form method='GET' action='' class='pagination-form'>";
    $pagination .= "<select name='perPage' onchange='this.form.submit()'>";
    $options = [5, 10, 20, 50, 100];
    foreach ($options as $option) {
        $selected = $option == $perPage ? "selected" : "";
        $pagination .= "<option value='$option' $selected>$option per page</option>";
    }
    $pagination .= "</select>";

    // Retain other query parameters
    foreach ($queryParams as $key => $value) {
        $pagination .= "<input type='hidden' name='$key' value='$value'>";
    }

    $pagination .= "</form>";
    return $pagination;
}
?>
