<?php
include "connection.php";
include "navbar.php";
?>
<html>
    <head>
        <title>Add Books</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
            .mydiv{
                margin-left: 20px;
                margin-top: 20px;
                display:  inline-flex;

            }
            .search{
                padding-left: 900px; 
            }
            body {
                background-image: url('images/book.jpg');
                background-size: 100%;
                transition: background-color .5s;

            }

            .sidenav {
                height: 100%;
                margin-top: 100px;
                width: 0;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: #e8d192;
                overflow-x: hidden;
                transition: 0.5s;
                padding-top: 60px;

            }

            .sidenav a {
                padding: 8px 8px 8px 32px;
                text-decoration: none;
                font-size: 25px;
                color: #695a33;
                display: block;
                transition: 0.3s;
            }

            .sidenav a:hover {
                color: #f1f1f1;
            }

            .sidenav .closebtn {
                position: absolute;
                top: 0;
                right: 25px;
                font-size: 36px;
                margin-left: 50px;
            }

            #main {
                transition: margin-left .5s;
                padding: 16px;
            }

            @media screen and (max-height: 450px) {
                .sidenav {padding-top: 15px;}
                .sidenav a {font-size: 18px;}
            }
            .book{
                width: 500px;
                margin: 0px auto;
            }
            .center{
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 50%;
                padding-right: unset;
                border-radius: 50%;
            }
            .rd{
                margin-top: -5px;
            }
            .custom-control-input:checked~.custom-control-label::before{
                color: #fff;
                border-color: #d39e00;
                background-color: #f6f64c;
            }
        </style>
    </head>
    <body>
        <!-------------------------------sidenav------------------------------------------>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div style=""><br>
                <?php
                if (isset($_SESSION['login_user'])) {
                    echo "<img class='center' src='images/" . $_SESSION['pic'] . "'>";
                    ?>
                </div>
                <div style="text-align: center; font-size: 20px;">
                    <?php
                    echo "<div style='margin-top:10px;'>" . ($_SESSION['login_user']) . "</div>";
                }
                ?>
            </div>
            <a href="add.php">Add Books</a>
            <a href="request.php">Book Request</a>
            <a href="issue_info.php">Issue Information</a>
            <a href="return.php">Return Book</a>
            <a href="fine.php">Fine</a>
            <a href="history.php">History</a>
        </div>

        <div id="main">

            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
            <?php if (isset($_SESSION['login_user'])) { ?>
                <h2 style="text-align: center;margin-bottom: 30px;">Add New Books</h2>
                <form class="book" action="" method="post">

                    <input type="text" name="name" class="form-control" placeholder="Book Name" required=""><br>
                    <input type="text" name="authors" class="form-control" placeholder="Author Name" required=""><br>
                    <select name="edition" class="form-control" required="">
                        <option disabled selected value> -- Select Book Edition -- </option>
                        <option value="1st">1st</option><option value="2nd">2nd</option><option value="3rd">3rd</option><option value="4th">4th</option><option value="5th">5th</option><option value="6th">6th</option><option value="7th">7th</option><option value="8th">8th</option><option value="9th">9th</option><option value="10th">10th</option><option value="11th">11th</option><option value="12th">12th</option><option value="13th">13th</option><option value="14th">14th</option><option value="15th">15th</option><option value="16th">16th</option><option value="17th">17th</option><option value="18th">18th</option><option value="19th">19th</option><option value="20th">20th</option><option value="21st">21st</option><option value="22nd">22nd</option><option value="23rd">23rd</option><option value="24th">24th</option><option value="25th">25th</option><option value="26th">26th</option><option value="27th">27th</option><option value="28th">28th</option><option value="29th">29th</option><option value="30th">30th</option><option value="31st">31st</option><option value="32nd">32nd</option><option value="33rd">33rd</option><option value="34th">34th</option><option value="35th">35th</option><option value="36th">36th</option><option value="37th">37th</option><option value="38th">38th</option><option value="39th">39th</option><option value="40th">40th</option><option value="41st">41st</option><option value="42nd">42nd</option><option value="43rd">43rd</option><option value="44th">44th</option><option value="45th">45th</option><option value="46th">46th</option><option value="47th">47th</option><option value="48th">48th</option><option value="49th">49th</option><option value="50th">50th</option><option value="51st">51st</option><option value="52nd">52nd</option><option value="53rd">53rd</option><option value="54th">54th</option><option value="55th">55th</option><option value="56th">56th</option><option value="57th">57th</option><option value="58th">58th</option><option value="59th">59th</option><option value="60th">60th</option><option value="61st">61st</option><option value="62nd">62nd</option><option value="63rd">63rd</option><option value="64th">64th</option><option value="65th">65th</option><option value="66th">66th</option><option value="67th">67th</option><option value="68th">68th</option><option value="69th">69th</option><option value="70th">70th</option><option value="71st">71st</option><option value="72nd">72nd</option><option value="73rd">73rd</option><option value="74th">74th</option><option value="75th">75th</option><option value="76th">76th</option><option value="77th">77th</option><option value="78th">78th</option><option value="79th">79th</option><option value="80th">80th</option><option value="81st">81st</option><option value="82nd">82nd</option><option value="83rd">83rd</option><option value="84th">84th</option><option value="85th">85th</option><option value="86th">86th</option><option value="87th">87th</option><option value="88th">88th</option><option value="89th">89th</option><option value="90th">90th</option><option value="91st">91st</option><option value="92nd">92nd</option><option value="93rd">93rd</option><option value="94th">94th</option><option value="95th">95th</option><option value="96th">96th</option><option value="97th">97th</option><option value="98th">98th</option><option value="99th">99th</option><option value="100th">100th</option>
                    </select>
                        <br>


                    <select name="quantity" class="form-control" required="">
                        <option disabled selected value> -- Select Book Quantity -- </option>
                        <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option><option value="60">60</option><option value="61">61</option><option value="62">62</option><option value="63">63</option><option value="64">64</option><option value="65">65</option><option value="66">66</option><option value="67">67</option><option value="68">68</option><option value="69">69</option><option value="70">70</option><option value="71">71</option><option value="72">72</option><option value="73">73</option><option value="74">74</option><option value="75">75</option><option value="76">76</option><option value="77">77</option><option value="78">78</option><option value="79">79</option><option value="80">80</option><option value="81">81</option><option value="82">82</option><option value="83">83</option><option value="84">84</option><option value="85">85</option><option value="86">86</option><option value="87">87</option><option value="88">88</option><option value="89">89</option><option value="90">90</option><option value="91">91</option><option value="92">92</option><option value="93">93</option><option value="94">94</option><option value="95">95</option><option value="96">96</option><option value="97">97</option><option value="98">98</option><option value="99">99</option><option value="100">100</option>
                    </select>
                    <br>
                    <select name="department" class="form-control"  required="">
                        <option disabled selected value> -- Select Department -- </option>
                        <optgroup label="Fiction">
                            <option value="Action and adventure">Action and adventure</option>
                            <option value="Alternate history">Alternate history</option>
                            <option value="Anthology">Anthology</option>
                            <option value="Chick lit">Chick lit</option>
                            <option value="Children's">Children's</option>
                            <option value="Classic">Classic</option>
                            <option value="Comic book">Comic book</option>
                            <option value="Coming-of-age">Coming-of-age</option>
                            <option value="Crime">Crime</option>
                            <option value="Drama">Drama</option>
                            <option value="Fairytale">Fairytale</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Graphic novel">Graphic novel</option>
                            <option value="Historical fiction">Historical fiction</option>
                            <option value="Horror">Horror</option>
                            <option value="Mystery">Mystery</option>
                            <option value="Paranormal romance">Paranormal romance</option>
                            <option value="Picture book">Picture book</option>
                            <option value="Poetry">Poetry</option>
                            <option value="Political thriller">Political thriller</option>
                            <option value="Romance">Romance</option>
                            <option value="Satire">Satire</option>
                            <option value="Science fiction">Science fiction</option>
                            <option value="Short story">Short story</option>
                            <option value="Suspense">Suspense</option>
                            <option value="Thriller">Thriller</option>
                            <option value="Western">Western</option>
                            <option value="Young adult">Young adult</option>
                        </optgroup>
                        <optgroup label="Non-fiction">
                            <option value="Art/architecture">Art/architecture</option>
                            <option value="Autobiography">Autobiography</option>
                            <option value="Biography">Biography</option>
                            <option value="Business/economics">Business/economics</option>
                            <option value="Crafts/hobbies">Crafts/hobbies</option>
                            <option value="Cookbook">Cookbook</option>
                            <option value="Diary">Diary</option>
                            <option value="Dictionary">Dictionary</option>
                            <option value="Encyclopedia">Encyclopedia</option>
                            <option value="Guide">Guide</option>
                            <option value="Health/fitness">Health/fitness</option>
                            <option value="History">History</option>
                            <option value="Home and garden">Home and garden</option>
                            <option value="Humor">Humor</option>
                            <option value="Journal">Journal</option>
                            <option value="Math">Math</option>
                            <option value="Memoir">Memoir</option>
                            <option value="Philosophy">Philosophy</option>
                            <option value="Prayer">Prayer</option>
                            <option value="Religion, spirituality, and new age">Religion, spirituality, and new age</option>
                            <option value="Textbook">Textbook</option>
                            <option value="True crime">True crime</option>
                            <option value="Review">Review</option>
                            <option value="Science">Science</option>
                            <option value="Self help">Self help</option>
                            <option value="Sports and leisure">Sports and leisure</option>
                            <option value="Travel">Travel</option>
                        </optgroup>
                    </select>
                    <br>
                    <div class="rd">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="defaultChecked" name="status" checked value="Available">
                            <label class="custom-control-label"  for="defaultChecked">Available</label>
                        </div>

                        <!-- Default unchecked -->
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="defaultUnchecked" name="status" value="Not Available">
                            <label class="custom-control-label"  for="defaultUnchecked">Not Available</label>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-secondary" name="submit" type="submit">Add Book</button>
                </form>
            <?php } else {
                ?>
                <br> <h4 style="color: yellowgreen;text-align: center;">Login to Add Books</h4>
                <center><button name="ok" type="button" class="btn btn-primary"><a style="text-decoration: none;color: white;" href="admin_login.php">LOGIN</a></button></center>
                <?php
            }
            ?> 
        </div>

        <?php
        if (isset($_POST['submit'])) {
            if (isset($_SESSION['login_user'])) {
                mysqli_query($db, "INSERT INTO books(`name`, `authors`, `edition`, `status`, `quantity`, `department`) VALUES('$_POST[name]','$_POST[authors]','$_POST[edition]','$_POST[status]','$_POST[quantity]','$_POST[department]');");
                ?>
                <!------------------------------------------------------------------add------------------------------------------------------------->



                <!-- The Modal -->
                <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

                    <div class="modal-dialog modal-dialog-centered">

                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Book Added Successfully&#9989;</h4>
                                <button type="button" class="close"><a style="text-decoration: none;color: #808080;" href="add.php">&times;</a></button>
                            </div>



                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <form method="post" action="">
                                    <button name="ok" type="button" class="btn btn-primary"><a style="text-decoration: none;color: white;" href="books.php">OK</a></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-backdrop fade show"></div>
                <!------------------------------------------------------------------add------------------------------------------------------------->
                <?php
            } else {
                ?>
                <!------------------------------------------------------------------Login------------------------------------------------------------->



                <!-- The Modal -->
                <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

                    <div class="modal-dialog modal-dialog-centered">

                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Please Login First to add the Books</h4>
                                <button type="button" class="close"><a style="text-decoration: none;color: #808080;" href="books.php">&times;</a></button>
                            </div>



                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <form method="post" action="">
                                    <button name="ok" type="button" class="btn btn-primary"><a style="text-decoration: none;color: white;" href="admin_login.php">Login</a></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-backdrop fade show"></div>
                <!------------------------------------------------------------------Login------------------------------------------------------------->
                <?php
            }
        }
        ?>
        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "300px";
                document.getElementById("main").style.marginLeft = "300px";
                document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("main").style.marginLeft = "0";
                document.body.style.backgroundColor = "";
            }
        </script>

    </body>
</html>