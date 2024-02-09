<div class="block-hero container pb-12">
    <div class="flex flex-col justify-between relative pb-12 text-center lg:flex-row lg:text-start lg:pb-32">
        <div class="justify-center pt-32 md:pt-36 xl:pt-44 order-2 lg:order-1">
            <h4 class="pb-6">The Mangcoding team will help build a website for your <br> company with quality and guaranteed services, with <br> custom templates you can create a website as you like.</h4>
            <!-- <a class="flex items-center justify-center text-xs font-normal gap-2 lg:justify-start" href="">View More <span> <img src="<?php echo _RESOURCES_SVG . '/icon-arrow.svg' ?>" class="svg-img"></span> </a> -->
            <?php 
                get_template_part( 'template-parts/elements/more-button', 'primary', [
                    'link' => '#',
                    'label' => 'Read More',
                    'classes' => ''
                ] );
            ?>
        </div>
        <img src="<?php echo _RESOURCES_SVG . '/icon-line.svg' ?>" class="svg-img w-20 mt-64 absolute rotate-90 ml-[40%] md:ml-[45%] lg:w-28 lg:mt-40 lg:ml-[40%] lg:rotate-0 xl:w-40 xl:mt-48 xl:ml-[36%]">


        <div class=" order-1 lg:order-2 flex flex-col items-center lg:items-end pb-5 lg:pb-0">
            <h1 class="text-6xl font-bold  lg:text-8xl lg:text-right xl:text-9xl">Your Digital</h1>
            <h2 class="text-6xl w-fit font-bold  lg:text-8xl lg:text-right xl:text-9xl text-bg-hero  ">Excellence</h2>
            <h2 class="text-6xl font-bold  lg:text-8xl lg:text-right xl:text-9xl">Begins Here</h2>
        </div>

    </div>

    <div class="grid grid-cols-4 justify-items-center border-y-2 border-[#302c2c]">
        <div class="pt-2">
            <h1 class="text-3xl font-bold pb-3 md:text-4xl lg:text-6xl">20 <span class="text-primary"> + </span> </h1>
            <p class="text-[0.5rem] lg:text-xs">Satisfied Client</p>
        </div>
        <div class="pt-2">
            <h1 class="text-3xl font-bold pb-3 md:text-4xl lg:text-6xl">20 <span class="text-primary"> + </span></h1>
            <p class="text-[0.5rem] lg:text-xs">Project</p>
        </div>
        <div class="pt-2">
            <h1 class="text-3xl font-bold pb-3 md:text-4xl lg:text-6xl">4000 <span class="text-primary"> + </span></h1>
            <p class="text-[0.5rem] lg:text-xs">Hours of work</p>
        </div>
        <div class="pt-2 pb-4">
            <h1 class="text-3xl font-bold pb-3 md:text-4xl lg:text-6xl">7 <span class="text-primary"> + </span></h1>
            <p class="text-[0.5rem] lg:text-xs">Countries</p>
        </div>
    </div>
</div>
</div>