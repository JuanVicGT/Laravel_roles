<?php

namespace App\Utils;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ImportData
{
    /**
     * Obtiene los datos de un archivo CSV y los devuelve como un array asociativo.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  array  $filleableColumns
     * @return array
     */
    public static function getImportDataFromCSV(&$file, $filleableColumns): array
    {
        $returnRows = []; // Array para guardar los datos de manera asociativa

        $intRow = 0; // Para indicar la fila de los titulos y determinar cuál es la fila de los datos
        if (($handle = fopen($file->getRealPath(), 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 0, ",")) !== FALSE) {

                // Detectamos que columna pertenece a cada campo
                if ($intRow === 0) {
                    foreach ($row as $key => $csvColumn) {
                        if (!isset($filleableColumns[$csvColumn])) {
                            continue;
                        }

                        $filleableColumns[$csvColumn]["key"] = $key;
                    }

                    $intRow++;
                    continue;
                }

                // Creamos el array para guardar los datos
                $dataRow = [];
                foreach ($filleableColumns as $key => $data) {
                    if (!isset($row[$data['key']]) && !isset($data['default'])) {
                        continue;
                    }

                    // Obtenemos el dato
                    $value = $row[$data['key']] ?? null;

                    // Verificamos si el dato es vacio y si existe un default
                    if (($value === "" || $value === null) && isset($data['default'])) {
                        $value = $data['default'];
                    }

                    // Verificamos el tipo de dato, de encontrarse lo formateamos
                    if (isset($data['type'])) {
                        $value = match ($data['type']) {
                            'boolean' => $value === '1' || strtolower($value) === 'true',
                            'integer' => (int) $value,
                            'float' => (float) $value,
                            'password' => Hash::make($value),
                            'random_username' => Str::random(8),
                            'random_email' => Str::random(8) . '@gmail.com',
                            default => $value,
                        };
                    }

                    $dataRow[$data['column']] = $value;
                }
                $returnRows[] = $dataRow;
            }
            fclose($handle);
        }

        return $returnRows;
    }
}
