<?php

namespace App\Http\Controllers;

use App\Models\Source;
use App\Models\GlobalField;
use App\Models\SourceFieldMapping;
use Illuminate\Http\Request;

class SourceFieldMappingController extends Controller
{
    public function index(
        Source $source
    ) {

        $fields =
            $source
                ->detectedFields()
                ->orderBy('field_name')
                ->get();

        $globalFields =
            GlobalField::orderBy(
                'name'
            )->get();

        $existingMappings =
            $source
                ->fieldMappings()
                ->pluck(
                    'global_field_id',
                    'source_field'
                )
                ->toArray();

        return view(
            'sources.mappings.index',
            compact(
                'source',
                'fields',
                'globalFields',
                'existingMappings'
            )
        );
    }

    public function store(
        Request $request,
        Source $source
    ) {

        SourceFieldMapping::where(
            'source_id',
            $source->id
        )->delete();

        foreach (
            $request->mappings ?? []
            as $sourceField =>
            $globalFieldId
        ) {

            if (!$globalFieldId) {
                continue;
            }

            SourceFieldMapping::create([

                'source_id' =>
                    $source->id,

                'source_field' =>
                    $sourceField,

                'global_field_id' =>
                    $globalFieldId,
            ]);
        }

        return back()->with(
            'success',
            'Mapeos guardados correctamente'
        );
    }
}