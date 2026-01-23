<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <header class="text-center mb-12 reveal-up">
        <h2 class="font-heading text-4xl md:text-5xl font-extrabold text-candelaria-purple mb-4">
            +20 Danzas Representativas
        </h2>
        <p class="text-gray-600 text-xl max-w-3xl mx-auto">
            Un recorrido por el vasto patrimonio inmaterial de Puno, la Capital del Folklore Peruano.
        </p>
    </header>

    <!-- SECTION I: TESOROS PATRIMONIALES -->
    <div class="mb-16">
        <div class="flex items-center gap-4 mb-8">
            <div class="h-px bg-gray-200 flex-1"></div>
            <h3 class="font-heading text-2xl font-bold text-gray-900 uppercase tracking-widest text-center flex items-center gap-3">
                <span class="text-candelaria-gold text-4xl">I.</span> 
                <span class="flex flex-col text-left">
                    <span>Tesoros Patrimoniales</span>
                    <span class="text-xs text-candelaria-gold font-normal normal-case">Declarados Patrimonio Cultural de la Nación</span>
                </span>
            </h3>
            <div class="h-px bg-gray-200 flex-1"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $patrimonio_dances = [
                [
                    'title' => 'AYARACHI',
                    'location' => 'Provincia de Lampa - Paratía',
                    'desc' => 'Danza declarada Patrimonio Cultural de la Nación en 2004. Es una expresión fúnebre y ritual del altiplano, de carácter sagrado con simbolismo del cóndor como animal totémico. Representa una de las formas más antiguas de música y danza del altiplano puneño.',
                    'img' => 'https://radioondaazul.com/wp-content/uploads/2024/04/Ayarachis-de-Paratia-.jpg'
                ],
                [
                    'title' => 'WIFALA DE SAN ANTONIO DE PUTINA',
                    'location' => 'Provincia de San Antonio de Putina',
                    'desc' => 'Declarada Patrimonio Cultural de la Nación en 2014. Danza pastoril amorosa de gran complejidad coreográfica que se ejecuta durante los carnavales. Los varones demuestran su virilidad resistiendo los latigazos de las mujeres en la "guerra-tupay".',
                    'img' => 'https://i.ytimg.com/vi/EoJO-bFrSaw/maxresdefault.jpg'
                ],
                [
                    'title' => 'CARNAVAL DE SANTIAGO DE PUPUJA',
                    'location' => 'Provincia de Azángaro',
                    'desc' => 'Patrimonio Cultural de la Nación desde 2010. También conocido como "Pujllay", es una danza agrícola y costumbrista que se realiza en honor a los cerros protectores y la Pachamama. Destaca por su música con el "toqoro" (quena gigante) y su vestimenta con madejas de lana multicolor.',
                    'img' => 'https://muniazangaro.gob.pe/web/wp-content/uploads/2019/08/santiago-de-pupuja.jpg'
                ],
                [
                    'title' => 'SARAQUENAS Y NOVENANTES',
                    'location' => 'Provincia de Azángaro',
                    'desc' => 'Declaradas Patrimonio Cultural de la Nación en 2014. Expresión vinculada a la vida pastoral y agrícola, ejecutadas durante la fiesta del Señor de Exaltación. Combina prácticas rituales andinas con elementos europeos.',
                    'img' => 'https://scontent.flim6-4.fna.fbcdn.net/v/t39.30808-6/564126929_1232778735550433_8180798571325589060_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeFe5JT5Jy9NYjYBPvSRpeo3vKYG6sOzupe8pgbqw7O6l5kEDkMM4Til3dA_QiKFI1Q6noJCEC-TmSXIFbZ-IvMo&_nc_ohc=KCqjIrOjmiMQ7kNvwGnsOPZ&_nc_oc=Adks0YcFZsnpjqrjiw8ELrzKQYX6e20pGwI3tddnAXs4-ezHKjrf6ZqvubhYBSkFcws&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=HZNaymIltznRXpEWDljWhw&oh=00_Afpdsh1SWU1653hK_jPs_U2rrVbcFavaqh0FFqEOFpZE_g&oe=6979B28B'
                ],
                [
                    'title' => 'CHACAREROS / LAWA K\'UMUS',
                    'location' => 'Provincia de Puno - Ácora y Platería',
                    'desc' => 'Declarados Patrimonio Cultural de la Nación en 2016. Danza agrícola que representa el trabajo comunitario en las chacras. El nombre "Lawa K\'umus" proviene del aymara y está asociado a la siembra y cosecha.',
                    'img' => 'https://scontent.flim6-4.fna.fbcdn.net/v/t1.6435-9/84693496_2683926375009018_5643069921471496192_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeEch2kbh4Pw4NbOVM24Y9MDZqVFmwSHy9RmpUWbBIfL1HDJ1IpJ_-QPmp5rMxxtLBWANvb3dDpAop-wmcAF6HT0&_nc_ohc=GPldnW-b2vQQ7kNvwH9hzcC&_nc_oc=Adm0NzUK_l8PJtXrKJ4Wf8HJHuw1qk1JJvcJMLnzfxfZgqMhdPYQ-QIed07dwEUMv_E&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=OnYGTVNVn9Vxi7SKPPz8tw&oh=00_Afo8XSciFrYRLwL-ZbqAlSlPBj7ys5Lbtkk7CRjAHuaPBg&oe=699B664A'
                ],
                [
                    'title' => 'DIABLADA PUNEÑA',
                    'location' => 'Provincia de Puno',
                    'desc' => 'Con más de 300 años de historia, tiene sus orígenes en los rituales de ganaderos que bailaban con cabezas de animales sacrificados. Declarada Patrimonio Cultural de la Nación, representa la lucha entre el bien (Arcángel San Miguel) y el mal (demonios).',
                    'img' => 'https://radioondaazul.com/wp-content/uploads/2021/09/Diablada-Punena-.jpg'
                ],
                [
                    'title' => 'MORENADA / REY MORENO',
                    'location' => 'Provincia de Puno',
                    'desc' => 'Danzas de "luces" con raíces en la colonia. La Morenada representa la esclavitud africana en las minas, mientras que el Rey Caporal fusiona elementos de la Diablada. Declaradas Patrimonio Cultural de la Nación.',
                    'img' => 'https://i.ytimg.com/vi/qy2TWYUx2zI/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLCVn6l0cqVD6JLCigVQF8w2MwjIiQ'
                ],
                [
                    'title' => 'CHUNCHOS DE ESQUILAYA',
                    'location' => 'Provincia de Carabaya - Ayapata',
                    'desc' => 'Declarados Patrimonio Cultural de la Nación en 2019. Originaria de la nación Kallawaya, se ejecuta durante el Corpus Christi. Representa la resistencia cultural y los intercambios entre poblaciones andinas.',
                    'img' => 'https://radioondaazul.com/wp-content/uploads/2024/02/DSC_0338-scaled.jpg'
                ],
                [
                    'title' => 'WIFALAS SAN FRANCISCO JAVIER DE MUÑANI',
                    'location' => 'Provincia de Azángaro',
                    'desc' => 'Declarada Patrimonio Cultural de la Nación en 2015. Variante de la Wifala con larga tradición en la que convergen influencias culturales. Destaca por ser portadora de identidad para los pobladores de la provincia.',
                    'img' => 'https://radioondaazul.com/wp-content/uploads/2024/08/IMG_0378-scaled.jpg'
                ]
            ];

            foreach ($patrimonio_dances as $dance) {
                ?>
                <!-- Mod: Reduced height to 280px (Landscape) to accommodate horizontal photos without empty space -->
                <div class="group relative h-[300px] overflow-hidden rounded-xl shadow-xl border border-gray-200 cursor-pointer reveal-up">
                    <img src="<?= $dance['img'] ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" onerror="this.src='https://placehold.co/600x400/4c1d95/fbbf24?text=<?= urlencode($dance['title']) ?>'">
                    <div class="absolute inset-0 bg-gradient-to-t via-black/60 from-black to-transparent opacity-90 transition-opacity group-hover:opacity-80"></div>
                    <div class="absolute bottom-0 p-6 w-full">
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="bg-candelaria-gold text-purple-900 text-[10px] font-bold px-2 py-1 rounded inline-flex items-center">
                                <i data-lucide="award" class="w-3 h-3 mr-1"></i> Patrimonio Cultural
                            </span>
                            <span class="bg-white/20 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-1 rounded">
                                <?= $dance['location'] ?>
                            </span>
                        </div>
                        <h3 class="font-heading text-xl text-white mb-2 font-bold leading-tight drop-shadow-md">
                            <?= $dance['title'] ?>
                        </h3>
                        <p class="text-gray-200 text-xs leading-relaxed line-clamp-3 group-hover:line-clamp-none transition-all duration-300">
                            <?= $dance['desc'] ?>
                        </p>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <!-- SECTION II: EXPRESIONES DEL ALTIPLANO -->
    <div class="mb-16">
        <div class="flex items-center gap-4 mb-8">
            <div class="h-px bg-gray-200 flex-1"></div>
            <h3 class="font-heading text-2xl font-bold text-gray-900 uppercase tracking-widest text-center">
                <span class="text-candelaria-green">II.</span> Expresiones del Altiplano
            </h3>
            <div class="h-px bg-gray-200 flex-1"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $altiplano_dances = [
                [
                    'title' => 'LLAMERITOS DE CANTERÍA',
                    'location' => 'Provincia de Lampa',
                    'desc' => 'Danza de pastores que representa el manejo de llamas y alpacas.',
                    'img' => 'https://radioondaazul.com/wp-content/uploads/2020/10/Llameritos-de-Canter%C3%ADa.jpg' // Generic Carnival/Llameritos style
                ],
                [
                    'title' => 'SIKURIS DE TAQUILE',
                    'location' => 'Provincia de Puno - Isla de Taquile',
                    'desc' => 'Expresión primigenia del hombre andino ejecutada en mayo durante la época de sequía.',
                    'img' => 'https://live.staticflickr.com/3863/15336380565_0cd08dc610_k.jpg'
                ],
                [
                    'title' => 'CARNAVAL DE ARAPA',
                    'location' => 'Provincia de Azángaro',
                    'desc' => 'Danza agrícola y costumbrista en honor a la Pachamama.',
                    'img' => 'https://radioondaazul.com/wp-content/uploads/2025/02/4-102-1024x683.jpg',
                    'patrimonio' => true
                ],
                [
                    'title' => 'CARNAVAL DE ICHU',
                    'location' => 'Provincia de Puno',
                    'desc' => 'Danza pastoril amorosa de la zona aimara practicada por "chiris" o "icheños".',
                    'img' => 'https://scontent.flim6-4.fna.fbcdn.net/v/t39.30808-6/555617574_24536831599291848_1755074950630833310_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=cf85f3&_nc_eui2=AeHhO34qg8LT2tVWVomAjD3iRx5jM1de27tHHmMzV17bu4ksc3G7NvgoY5Y5wsg6YP0Lz8vsqHHZY233r_vb6IPo&_nc_ohc=1GncwSCoYAgQ7kNvwFT0xGO&_nc_oc=AdmgvqWnXBjcm-QGR81y12J0kjcLLXTIoTnsAbh4wW8wLJF2Mswcv2EPdbJ5ZX_f_sE&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=WpMpwg6zXUu_zaPgk7FvXA&oh=00_Afp34hIbu7vJGWPdogD9J1ZX-C54WYqyd-XkrFF4VP128Q&oe=6979B777'
                ],
                [
                    'title' => 'K\'AJELO / K\'ARA BOTAS',
                    'location' => 'Provincias de Azángaro y Melgar',
                    'desc' => 'Danza de jinetes bravíos que representa al "morochuco" puneño.',
                    'img' => 'https://radioondaazul.com/wp-content/uploads/2024/10/Festival-de-Kajelos-en-el-distrito-de-Pichacani-Laraqueri.jpg'
                ],
                [
                    'title' => 'KALLAHUAYA',
                    'location' => 'Provincia de Puno',
                    'desc' => 'Danza de los curanderos itinerantes del altiplano.',
                    'img' => 'https://scontent.flim6-4.fna.fbcdn.net/v/t1.6435-9/66023960_10156762416943621_5653827504582950912_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeGZKPBE-mwOX4wGON4V9YFDBAAOXtlj6bIEAA5e2WPpshROTOnL-_HtU__GNqxIf865HfU7wu-854acHKv15ZS6&_nc_ohc=JBEuzc13cmQQ7kNvwEYkFuc&_nc_oc=AdmnF9e_5ZGkC9kpBaEYsth_Hyvqw7dKaEI-YCyYrWTVyM0YywjhtcfFjypWeFHFa9Y&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=_xxgwuR3BQIFfxkBxfc9IQ&oh=00_Afo5olDjJEfas8yFOTaLFaYmDqTBdfDGWQjqYwxHkKk6jQ&oe=699B5181'
                ],
                [
                    'title' => 'PULI PULIS',
                    'location' => 'Provincia de Chucuito y Lampa',
                    'desc' => 'Danza de cazadores que utiliza instrumentos de viento como la quena.',
                    'img' => 'https://scontent.flim6-4.fna.fbcdn.net/v/t39.30808-6/489077871_1082126530616083_8469257461569691796_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeGWXw9Dd2FrM225w50i9y5s8ugbczRauo7y6BtzNFq6jvSVgRY8lqaNmZXEk73YWE5CEsPTyaHfxAkiMZMJw68p&_nc_ohc=JcUwaIZTF20Q7kNvwG1GfjL&_nc_oc=Adl0oNWkbBl3BpMXhVh7vYAjL3qsbRhT39e0TlqdrIMsMLNg_L0BU_cSPpU4FfTWY_w&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=pYT4JdVp9FoPy5z76XrMHA&oh=00_AfqdnaKd-_6Hf6Cd8xLI5H96Vlm5uPpDfai21hCZqS49Sw&oe=6979E191'
                ],
                [
                    'title' => 'UNOCAJAS / UNUCAJAS',
                    'location' => 'Provincias de Azángaro y Lampa',
                    'desc' => 'Danza de pastoras que representa el trabajo con llamas y alpacas.',
                    'img' => 'https://radioondaazul.com/wp-content/uploads/2024/02/Conjunto-Unucajas-de-Azangaro.jpg',
                    'patrimonio' => true
                ],
                [
                    'title' => 'CHOQUELAS',
                    'location' => 'Provincia de Yunguyo - Copani',
                    'desc' => 'Danza autóctona representada en el concurso por el grupo del Centro Poblado de Calacoto.',
                    'img' => 'https://scontent.flim6-4.fna.fbcdn.net/v/t39.30808-6/481302852_612794465047186_90064108125164913_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=f727a1&_nc_eui2=AeEFxU_ClnVSMmSN3cqqjhmHKAvZUW7OItQoC9lRbs4i1COUeekFNlqmfT1ELrRc2PaUFdmwWtmLAqnV602hHUFJ&_nc_ohc=DWh9kKyUXHsQ7kNvwESr95N&_nc_oc=Adn56ThjzLB5CL2QelHA0UVwcd7kPw03wyo_Zmb60_ZqXZk8dEhVILp1CrZS9v0SNnI&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=ij87mnP-sn_Uu8H9yLNvbA&oh=00_AfpOFnO8YYKQqRNMZYi3LPyTzDfLOm9DQ39BsLblHjrmxg&oe=6979BC64'
                ],
                [
                    'title' => 'WARAK\'EROS / HUARACHEROS',
                    'location' => 'Provincia de Sandia',
                    'desc' => 'Danza de cazadores que utilizan la "waraka" (honda) como elemento central.',
                    'img' => 'https://portal.andina.pe/EDPfotografia3/Thumbnail/2018/11/19/000545219W.webp',
                    'patrimonio' => true
                ],
                [
                    'title' => 'CHULLUNQUIANI PALCA',
                    'location' => 'Provincia de Lampa',
                    'desc' => 'Danza del distrito de Palca, zona de transición entre el altiplano y la ceja de selva.',
                    'img' => 'https://scontent.flim6-4.fna.fbcdn.net/v/t39.30808-6/485364643_977656191186057_7574299764486013087_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeHzUObhHCyzKro8ADkHiyfY05gzOBrw-e_TmDM4GvD576iAaZxxifYOfMp9dLBSBwavJ0VfhCSGr16SFrwCSF8C&_nc_ohc=5HVAVKlxvk0Q7kNvwHepM5B&_nc_oc=AdlbawPskSQ-02PYFlE9wLsloDgpmqVH70JLzQ7nDkGKl1c3EQmQD0pBbay6ANga9N0&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=EX16Nikxq1rKXkXtNCjSgQ&oh=00_AfqQJngkHXGBHsRbgMgfHTXaBxeresGzry6nLt9wMfiklA&oe=6979E40C' // Placeholder style URL
                ],
                [
                    'title' => 'CARNAVAL DE CHUCUITO',
                    'location' => 'Provincia de Chucuito',
                    'desc' => 'Expresión aymara lacustre que se ejecuta en el "Lugar de la Triada" (Chucuito).',
                    'img' => 'https://scontent.flim6-3.fna.fbcdn.net/v/t1.6435-9/55593286_841539319540627_6219054911657607168_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=cf85f3&_nc_eui2=AeGBMejCY68y18d5593Ov2pJTnMEhQlCAxlOcwSFCUIDGc4eVJOaGsjVGSDoYJNguBM5FbQEDidfAN5CRpcY4Tq-&_nc_ohc=uSlr-NxY1RwQ7kNvwE7_dRo&_nc_oc=AdnJqKG-Q980K1qQGGAMX4jQryFuc5SG0_ENTleks8oJq1KYyC0nGWRwQnQxf7Af3ac&_nc_zt=23&_nc_ht=scontent.flim6-3.fna&_nc_gid=xq_7KsvFbv9JhG1QeUp5nA&oh=00_AfpWj1MsYy1dEIaQFRhZmCatNkIW1LEHQIDE_pYKc3EzCA&oe=699B65C9'
                ],
                [
                    'title' => 'CHACALLADA',
                    'location' => 'Provincia de Puno - Camacani',
                    'desc' => 'Danza de comunidades campesinas que representa el trabajo agrícola colectivo.',
                    'img' => 'https://radioondaazul.com/wp-content/uploads/2025/02/portada-1-6.jpg'
                ],
                [
                    'title' => 'Q\'ASWA / QHASWA',
                    'location' => 'Provincia de Puno - Capachica',
                    'desc' => 'Danza de solteros ejecutada en carnavales.',
                    'img' => 'https://scontent.flim6-3.fna.fbcdn.net/v/t1.6435-9/102937698_1374594949401954_4726617135406157239_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeEvMvqohprmAfMqzM-obOF1E4h5oP9M9x0TiHmg_0z3HRIApwcqDPFqnVvRRQMIhAbNKvDe7_acp1-RDtvk6LBx&_nc_ohc=wa8My3BQ2IwQ7kNvwFKRUTW&_nc_oc=AdkGIS6WwQV0o45KJvWFxCJfC1eu4NkjcvSnR6CqbN9c0UHVrWZguDDtsNYgyOUH8SM&_nc_zt=23&_nc_ht=scontent.flim6-3.fna&_nc_gid=wk1i0zVBgA-Y9wKeyfP0Ug&oh=00_AfpLZ0jqQJSxU_-Y_phnrMMyA690BKSQ4XBrwzT_SyAskg&oe=699B6058'
                ],
                [
                    'title' => 'TURCOS DE CABANILLA',
                    'location' => 'Provincia de Lampa',
                    'desc' => 'Danza satírica que representa a los arrieros o comerciantes ("turcos") de la región.',
                    'img' => 'https://scontent.flim6-4.fna.fbcdn.net/v/t39.30808-6/485182243_977654271186249_7562324481258543829_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeGzoHB6DfPIvyfPkCgfvFvIMNg8R4C0ZTYw2DxHgLRlNo0MGKMs28_7gc3ubaFZiBWj4ij2KLMU01nWl753Iv0J&_nc_ohc=WNBMYmgMGwoQ7kNvwHLayZD&_nc_oc=AdkHS-nVnkvRNnG9zoQmpSEca4CS6zqi0N_lWwxnWGJdaHg_10wOQcL3U0ixeau-bBs&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=PN6sHfohEjrwFCCgjw612w&oh=00_Afpb8-8UEMQeV8Ye5yhdsMX8HEmfXSnL9-iYtdviNFwfCw&oe=6979D759'
                ],
                [
                    'title' => 'CARNIVAL DE PATAMBUCO',
                    'location' => 'Provincia de Sandia',
                    'desc' => 'Danza de la zona de frontera con Bolivia.',
                    'img' => 'https://radioondaazul.com/wp-content/uploads/2024/02/DSC_0109-scaled.jpg',
                    'patrimonio' => true
                ],
            ];

            foreach ($altiplano_dances as $dance) {
                ?>
                <!-- Mod: Reduced height to 280px (Landscape) -->
                <div class="group relative h-[300px] overflow-hidden rounded-xl shadow-xl border border-gray-200 cursor-pointer reveal-up">
                    <img src="<?= $dance['img'] ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" onerror="this.src='https://placehold.co/600x400/4c1d95/fbbf24?text=<?= urlencode($dance['title']) ?>'">
                    <div class="absolute inset-0 bg-gradient-to-t via-black/60 from-black to-transparent opacity-90 transition-opacity group-hover:opacity-80"></div>
                    <div class="absolute bottom-0 p-6 w-full">
                        <div class="flex flex-wrap gap-2 mb-2">
                            <?php if (!empty($dance['patrimonio'])): ?>
                                <span class="bg-candelaria-gold text-purple-900 text-[10px] font-bold px-2 py-1 rounded inline-flex items-center">
                                    <i data-lucide="award" class="w-3 h-3 mr-1"></i> Patrimonio Cultural
                                </span>
                            <?php endif; ?>
                            <span class="bg-candelaria-purple/80 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-1 rounded inline-block">
                                <?= $dance['location'] ?>
                            </span>
                        </div>
                        <h3 class="font-heading text-xl text-white mb-2 font-bold leading-tight drop-shadow-md">
                            <?= $dance['title'] ?>
                        </h3>
                        <p class="text-gray-200 text-xs leading-relaxed line-clamp-3 group-hover:line-clamp-none transition-all duration-300">
                            <?= $dance['desc'] ?>
                        </p>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    
    <!-- Curiosidades (Manteniendo sección existente) -->
    <div class="mt-20 bg-candelaria-dark text-white rounded-3xl p-8 md:p-12 relative overflow-hidden reveal-up">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        
        <div class="relative z-10">
            <h2 class="font-heading text-3xl md:text-4xl font-bold mb-12 text-center text-candelaria-gold">¿Sabías que...?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Fact 01 -->
                <div class="text-center group">
                    <div class="w-20 h-20 mx-auto bg-candelaria-purple rounded-full flex items-center justify-center mb-6 shadow-lg transform group-hover:scale-110 transition-transform border-4 border-white/20">
                        <span class="font-heading text-3xl font-bold text-white">01</span>
                    </div>
                    <h4 class="text-2xl font-bold mb-3 text-candelaria-light">El Sonido del Agua</h4>
                    <p class="text-white text-lg leading-relaxed font-medium">
                        En los <span class="text-candelaria-gold font-bold">Unucajas de Azángaro</span>, se introduce agua en los tambores para que el sonido sea más pesado y grave, imitando la lluvia que fertiliza los campos.
                    </p>
                </div>

                <!-- Fact 02 -->
                <div class="text-center group">
                    <div class="w-20 h-20 mx-auto bg-candelaria-red rounded-full flex items-center justify-center mb-6 shadow-lg transform group-hover:scale-110 transition-transform border-4 border-white/20">
                        <span class="font-heading text-3xl font-bold text-white">02</span>
                    </div>
                    <h4 class="text-2xl font-bold mb-3 text-candelaria-light">Plumas Sagradas</h4>
                    <p class="text-white text-lg leading-relaxed font-medium">
                        Los penachos de los <span class="text-candelaria-gold font-bold">Ayarachis</span> pueden llegar a medir más de un metro y utilizan plumas de flamencos andinos (parihuanas), aves sagradas desde tiempos inmemoriales.
                    </p>
                </div>

                <!-- Stat -->
                <div class="text-center group">
                    <div class="w-20 h-20 mx-auto bg-candelaria-gold rounded-full flex items-center justify-center mb-6 shadow-lg transform group-hover:scale-110 transition-transform border-4 border-white/20">
                        <i data-lucide="users" class="w-10 h-10 text-candelaria-dark"></i>
                    </div>
                    <h4 class="text-4xl font-heading font-extrabold mb-3 text-white">+350</h4>
                    <div class="text-lg font-bold text-candelaria-gold uppercase tracking-widest mb-2">Conjuntos</div>
                    <p class="text-white text-base font-bold uppercase tracking-wider">Participantes</p>
                    <p class="text-white/80 text-base mt-3 italic font-medium">Un despliegue de fe y cultura único en el planeta.</p>
                </div>
            </div>
        </div>
    </div>
</div>
