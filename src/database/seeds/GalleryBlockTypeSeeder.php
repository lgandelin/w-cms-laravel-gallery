<?php

use CMS\Entities\BlockType;
use CMS\Context;
use Illuminate\Database\Seeder;

class GalleryBlockTypeSeeder extends Seeder {

    public function run()
    {
        $blockType = new BlockType();
        $blockType->setCode('gallery');
        $blockType->setName('Block Gallery');
        $blockType->setContentView('w-cms-laravel-gallery-back::editorial.blocks.gallery');
        $blockType->setFrontView('modules.gallery.blocks.gallery');
        $blockType->setOrder(9);

        Context::getRepository('block_type')->createBlockType($blockType);
        $this->command->info('Block type [' . $blockType->getCode() . '] inserted successfully !');
    }
}