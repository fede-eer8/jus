<?php

use Illuminate\Database\Seeder;
use LegalIS\TipoDocumento;

class TipoDocumentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipodocumento = new TipoDocumento();
        $tipodocumento->nombre = "Decreto";
        $tipodocumento->slug_fd = "Decretos";
        $tipodocumento->save();

        $tipodocumento = new TipoDocumento();
        $tipodocumento->nombre = "Resolución";
        $tipodocumento->slug_fd = "Resoluciones";
        $tipodocumento->save();

        $tipodocumento = new TipoDocumento();
        $tipodocumento->nombre = "Recurso";
        $tipodocumento->slug_fd = "Recursos";
        $tipodocumento->save();
    }
}
