<section id="filtre__bar" class="filtre__bar">

    

        <input type="checkbox" id="section-toggle-pris" class="section-toggle">
            <section class="filtre__bar__popup">
                <section class="filtre__container">
                                <section class="filter__column">
                                <section class="slidecontainer">
                                    <p>
                                        Min price : <b id="range_price_min_output"></b>,-
                                    </p>
                                    <input type="range" min="1" max="1000" value="0" class="slider" id="range_price_min" onchange="update_search(this)">
                                    <p>
                                        Max price : <b id="range_price_max_output"></b>,- 
                                    </p>
                                    <input type="range" min="1" max="1000" value="1000" class="slider" id="range_price_max" onchange="update_search(this)">
                                </section>
                            </section>
                            <section class="filter__column">
                                <section class="slidecontainer">
                                    <p>
                                        Min size : <b id="range_size_min_output"></b>
                                    </p>
                                    <input type="range" min="1" max="1000" value="0" class="slider" id="range_size_min" onchange="update_search(this)">
                                    <p>
                                        Max size : <b id="range_size_max_output"></b>
                                    </p>
                                    <input type="range" min="1" max="1000" value="1000" class="slider" id="range_size_max" onchange="update_search(this)">
                                </section>
                            </section>
                            <section class="filter__column">
                                <section class="slidecontainer">
                                    <p>
                                        Min beds : <b id="range_sleeps_min_output"></b>
                                    </p>
                                    <input type="range" min="1" max="1000" value="0" class="slider" id="range_sleeps_min" onchange="update_search(this)">
                                    <p>
                                        Max beds : <b id="range_sleeps_max_output"></b>
                                    </p>
                                    <input type="range" min="1" max="1000" value="1000" class="slider" id="range_sleeps_max" onchange="update_search(this)">
                                </section>
                            </section>
                </section>
            </section>
            <label for="section-toggle-pris" class="section-toggle-label">Filter</label>

            <?php
                $res = new Residence;
                if (!empty($_GET['from']) || !empty($_GET['to'])) {
                    $res->search_by_city_and_date($_GET['where'], $_GET['from'], $_GET['to']);
                } else {
                    $res->search_by_city_v2($_GET['where']);
                }
            ?>
</section>