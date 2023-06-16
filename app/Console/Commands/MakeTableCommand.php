<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Pluralizer;

class MakeTableCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:table {name} {--path=} {--table=} {--dt}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected function getStub()
    {
        return $this->resolveStubPath("/stubs/table.stub");
    }

    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__.$stub;
    }

    protected function getPath($name)
    {
        $path = $this->option("path");
        if($path == null){
            $path = $name;
        }
        return base_path('resources/views/'.$path.'/').'index.blade.php';
    }

    protected function rootNamespace()
    {
        return $this->argument('name');
    }

    protected function buildClass($name)
    {
        $names = Pluralizer::plural($name);
        $table = $this->option("table") == null ? $names : $this->option("table");
        $columns = Schema::getColumnListing($table);

        if(empty($columns)){
            $this->error("table ".$table." may not exist");
        }

        $replace = [
            "{{ model }}" => $name,
            "{{ modelC }}" => ucfirst($name),
            "{{ modelP }}" => $names,
            "{{ head }}" => $this->renderHead($columns),
            "{{ body }}" => $this->renderBody($name, $columns),
            "{{ dt }}" => ""
        ];
        if($this->hasOption('dt')){
            $replace['{{ dt }}'] = $this->buildDataTable();
        }

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    protected function renderHead($columns): string {
        $head = '';
        foreach ($columns as $column){
            $head .= "
            <th>".str_replace("_","",str_replace("_id","",ucfirst($column)))."</th>
            ";
        }
        return $head;
    }

    protected function renderBody($name, $columns): string {
        $body = "";
        foreach ($columns as $column){
            $body .= "
            <td>{{ $".$name."->$column }}</td>
            ";
        }
        return $body;
    }

    protected function buildDataTable(): string {
        $data = "
        @section('js')
        <script>
        $(document).ready(function() {
            $('#data').DataTable({
                dom: 'Bfrtip',
                buttons: []
            });
        })
        </script>
        @endsection
        ";
        return $data;
    }


}
