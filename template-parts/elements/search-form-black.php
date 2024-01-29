<form action="/" method="get" onsubmit="preventDefault();" class="mt-[104px] mb-[24px] lg:mt-[148px] lg:mb-[64px] w-full flex items-center justify-center search-wrapper">
    <div class="w-10/12 lg:w-6/12 h-[60px] flex items-center justify-between pl-8 pr-[14px] rounded-[53px] border border-[#001F22] search-input">
        <div class="flex w-full gap-6 search-group">
            <?php if (!wp_is_mobile()) : ?>
                <div class="relative inline-block text-left">
                    <div>
                        <button type="button" class="inline-flex w-full justify-center items-center gap-x-1 bg-transparent text-[14px] font-darkerGrotesque text-[#001F22]" id="category-button" aria-expanded="true" aria-haspopup="true">
                            Kategory
                            <svg class="mt-1 icon-dropdown-black" width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1L3.2 3.93333C3.6 4.46667 4.4 4.46667 4.8 3.93333L7 1" stroke="#001F22" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                    <div class="absolute left-0 z-10 mt-4 min-w-[224px] origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none categories-wrapper" style="display: none!important; z-index: -1!important;">
                        <div class="py-1 categories-list">
                            <?php foreach (mcd_get_terms() as $key => $value) : ?>
                                <button type="button" class="block px-4 py-2 text-[14px] font-darkerGrotesque text-[#001F22] category-item" id="<?php echo 'category-item-' . $value->term_id; ?>" data-slug="<?php echo $value->slug; ?>"><?php echo $value->name; ?></button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <svg class="line-vertical" width="2" height="28" viewBox="0 0 2 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 0L1 28" stroke="#C2C2C2" />
                </svg>
            <?php endif; ?>
            <input type="search" name="s" id="keywords" placeholder="Search Topics" required class=" w-full text-[14px] font-darkerGrotesque text-[#001F22] p-0 border-transparent
                            focus:border-transparent focus:ring-transparent">
        </div>
        <input type="hidden" name="cat" value="all">
        <button id="submit-search" type="submit" class="inline-flex p-[12px] gap-10 shrink-0" title="Search">
            <img class="svg-img" src="<?php echo _RESOURCES_SVG . '/ico-search-white.svg' ?>" alt="Search">
        </button>
    </div>
</form>