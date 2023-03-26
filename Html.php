<?php

class HTML {
    public function createTable(array $data): string {
        $table = "<table class=\"w-full text-sm text-left text-gray-500 dark:text-gray-400\">";
        $table .= "<thead class=\"text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400\">";
        $table .= "<tr>";
        foreach ($data[0] as $key => $value) {
            $table .= "<th scope=\"col\" class=\"px-6 py-3\">$key</th>";
        }
        $table .= "</tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach ($data as $row) {
            $table .= "<tr class=\"bg-white border-b dark:bg-gray-800 dark:border-gray-700\">";
            foreach ($row as $key => $value) {
                $table .= "<td class=\"px-6 py-4\">$value</td>";
            }
            $table .= "</tr>";
        }
        $table .= "</tbody>";
        $table .= "</table>";
        return $table;
    }
}