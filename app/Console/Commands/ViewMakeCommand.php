<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Pluralizer;

class ViewMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:form {name} {--path=} {--table=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make blade form';

    /**
     * Execute the console command.
     *
     * @return int
     */


    protected function getStub()
    {
        return $this->resolveStubPath("/stubs/form.stub");
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
        return base_path('resources/views/'.$path.'/').'form.blade.php';
    }

    protected function rootNamespace()
    {
        return $this->argument('name');
    }

    protected function buildClass($name)
    {
        $replace = [
            "{{ model }}" => $name,
            "{{ fields }}" => $this->renderFields($name)
        ];

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    protected function renderFields($name): string
    {
        $table = $this->option("table") == null ? Pluralizer::plural($name) : $this->option("table");
        $columns = Schema::getColumnListing($table);
        if(empty($columns)){
            $this->error("table ".$table." may not exist");
        }
        $fields = '';

        foreach ($columns as $column) {
            $columnCapitalized = str_replace("_","",str_replace("_id", "", ucfirst($column)));
            if($column != 'id' && $column != 'created_at' && $column != 'updated_at'){
                $fields .=
                    "
                 <div class='form-group'>
                    <label for='$column'>$columnCapitalized</label>
                    ".
                    $this->renderField($name, $column, $table)
                    .
                    "@error('$column')".
                    '
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                 '
                ;
            }
        }
        return $fields;
    }

    protected function renderField($name, $column, $table): string
    {
        $type = Schema::getColumnType($table, $column);
        $field = '';
        $this->info($type);
        if($type == 'boolean'){

        }
        elseif (strpos($column, "_id")){
            $parent = str_replace("_id","",$column);
            $pluralize = Pluralizer::plural($parent);
            $field = "<select id='$column' name='$column' class='form-select @error('$column') is-invalid @enderror' aria-label='Default select example'>
                        @foreach( $$pluralize as $$parent )
                            <option value='{{ $$parent"."->id }}' @isset($$name) @if($$parent"."->id == $$name"."->$column) selected @endif @endisset >{{ $$parent"."->name }}</option>
                        @endforeach
                    </select>";
        }
        elseif($type == 'text'){
            $field = "<textarea name='$column' id='$column' rows='7' class='form-control @error('$column') is-invalid @enderror'>
                          {{ isset($column) ? $name"."->$column : old('resume') }}
                      </textarea>";
        }
        else {
            $inputType = "text";
            if($type == 'date')
                $inputType = "date";
            if($type == 'datetime')
                $inputType = "datetime-local";
            $field = "<input type='$inputType' name='$column' id='$column' value='{{ isset($$name) ? $$name"."->$column : old('$column') }}' class='form-control @error('$column') is-invalid @enderror' />" ;
        }
        return $field;
    }
}
