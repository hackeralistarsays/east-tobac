<?php

namespace App\GraphQL\Mutations\Bales;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\Models\Bale;

class OffLoadBale
{
    /**
     * Return a value for the field.
     *
     * @param  @param  null  $root Always null, since this field has no parent.
     * @param  array<string, mixed>  $args The field arguments passed by the client.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Shared between all fields.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Metadata for advanced query resolution.
     * @return mixed
     */
    public function __invoke($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $bale = Bale::find($args['bale_id']);

        $bale->weight_at_off_loading = $args['weight_at_off_loading'];
        $bale->off_loading_date = $args['off_loading_date'];
        $bale->state = 'off-loaded';
        $bale->destination_store_id = $args['destination_store_id'];
        $bale->save();

        return ['bale' => $bale];
    }
}
