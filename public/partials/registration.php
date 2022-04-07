
<form id="regForm" action="#">
    <h1>Register:</h1>
    <!-- One "tab" for each step in the form: -->
    <div class="tab">
        <h2>What's your fitness goal?</h2>
        <p>We'll search through the thousands of workouts on Beachbody & recommend the right ones for you.</p>
        <div class="reg-content-wrapper">
            <ul>
                <li>
                    <label for="">Lose Weight</label>
                    <input type="checkbox" name="fitness_goal[]" onchange="statecheck(this)" value="lose weight">
                </li>
                <li>    
                    <label for="">Tone and define</label>
                    <input type="checkbox" name="fitness_goal[]" onchange="statecheck(this)" value="tone and define">
                </li>
                <li>    
                    <label for="">Sleep Better</label>
                    <input type="checkbox" name="fitness_goal[]" onchange="statecheck(this)" value="sleep better">
                </li>
                <li>    
                    <label for="">Increase endurance</label>
                    <input type="checkbox" name="fitness_goal[]" onchange="statecheck(this)" value="increase endurance">
                </li>
                <li>    
                    <label for="">Relieve Stress</label>
                    <input type="checkbox" name="fitness_goal[]" onchange="statecheck(this)" value="relieve stress">
                </li>
                <li>    
                    <label for="">Prep for an event</label>
                    <input type="checkbox" name="fitness_goal[]" onchange="statecheck(this)" value="prep for an event">
                </li>
            </ul>
        </div>
    </div>
    <div class="tab">
        <h2>What's your age?</h2>
        <p>Beachbody members across all age groups have lost as much as 9 lbs. in as little as 14 days.</p>
        <div class="reg-content-wrapper">
            <ul>
                <li>
                    <label for="">20s</label>
                    <input type="radio" name="age" onclick="radioClicked(this)" value="20">
                </li>
                <li>
                    <label for="">30s</label>
                    <input type="radio" name="age" onclick="radioClicked(this)" value="30">
                </li>
                <li>
                    <label for="">40s</label>
                    <input type="radio" name="age" onclick="radioClicked(this)" value="40">
                </li>
                <li>
                    <label for="">50s</label>
                    <input type="radio" name="age" onclick="radioClicked(this)" value="50">
                </li>
                <li>
                    <label for="">60s</label>
                    <input type="radio" name="age" onclick="radioClicked(this)" value="60">
                </li>
                <li>
                    <label for="">70s and above</label>
                    <input type="radio" name="age" onclick="radioClicked(this)" value="70+">
                </li>

            </ul>
        </div>
    </div>
    <div class="tab">
        <h2>How often do you work out?</h2>
        <p>There’s no wrong answer here – feel proud for showing up today!</p>
        <div class="reg-content-wrapper">
            <ul>
                <li>
                    <label for="">I don't currently exerciese</label>
                    <input type="radio" name="workout" onclick="radioClicked(this)" value="1">
                </li>
                <li>
                    <label for="">1-2x Per week</label>
                    <input type="radio" name="workout" onclick="radioClicked(this)" value="2">
                </li>
                <li>
                    <label for="">3-4x per week</label>
                    <input type="radio" name="workout" onclick="radioClicked(this)" value="3">
                </li>
                <li>
                    <label for="">5-6x per week</label>
                    <input type="radio" name="workout" onclick="radioClicked(this)" value="4">
                </li>
                <li>
                    <label for="">Every day</label>
                    <input type="radio" name="workout" onclick="radioClicked(this)" value="5">
                </li>
            </ul>
        </div>
    </div>
    <div class="tab">
        <h2>Life happens. Tell us how long you have to work out.</h2>
        <p>We’ll recommend the workouts that are just right for you.</p>
        <div class="reg-content-wrapper">
            <ul>
                <li>
                    <label for="">Under 20 minutes</label>
                    <input type="radio" name="workout_long" onclick="radioClicked(this)" value="1">
                </li>
                <li>
                    <label for="">20-40 minutes</label>
                    <input type="radio" name="workout_long" onclick="radioClicked(this)" value="2">
                </li>
                <li>
                    <label for="">More than 40 minutes</label>
                    <input type="radio" name="workout_long" onclick="radioClicked(this)" value="3">
                </li>
            </ul>
        </div>
    </div>
    <div class="tab">
        <h2>What are your favorite types of workouts?</h2>
        <div class="reg-content-wrapper">
            <ul>
                <li>
                    <label for="">Barre</label>
                    <input type="checkbox" name="workout_fav[]" onchange="statecheck(this)" value="barre">
                </li>
                <li>    
                    <label for="">Pilates</label>
                    <input type="checkbox" name="workout_fav[]" onchange="statecheck(this)" value="pilates">
                </li>
                <li>    
                    <label for="">strength Training</label>
                    <input type="checkbox" name="workout_fav[]" onchange="statecheck(this)" value="strength training">
                </li>
                <li>    
                    <label for="">Walking</label>
                    <input type="checkbox" name="workout_fav[]" onchange="statecheck(this)" value="walking">
                </li>
                <li>    
                    <label for="">Running</label>
                    <input type="checkbox" name="workout_fav[]" onchange="statecheck(this)" value="running">
                </li>
                <li>    
                    <label for="">HIIT</label>
                    <input type="checkbox" name="workout_fav[]" onchange="statecheck(this)" value="hiit">
                </li>
                <li>    
                    <label for="">Yoga</label>
                    <input type="checkbox" name="workout_fav[]" onchange="statecheck(this)" value="yoga">
                </li>
                <li>    
                    <label for="">Stretching</label>
                    <input type="checkbox" name="workout_fav[]" onchange="statecheck(this)" value="stretching">
                </li>
            </ul>
        </div>
    </div>
    <div class="tab">
        <h2>Are you interested in fitness extras?</h2>
        <div class="reg-content-wrapper">
            <ul>
                <li>
                    <label for="">Treadmill</label>
                    <input type="checkbox" name="fitness_extra[]" onchange="statecheck(this)" value="treadmill">
                </li>
                <li>    
                    <label for="">Excercise Bikes</label>
                    <input type="checkbox" name="fitness_extra[]" onchange="statecheck(this)" value="excercise bikes">
                </li>
                <li>    
                    <label for="">Strength Slides</label>
                    <input type="checkbox" name="fitness_extra[]" onchange="statecheck(this)" value="strength slides">
                </li>
                <li>    
                    <label for="">Resistance Bands</label>
                    <input type="checkbox" name="fitness_extra[]" onchange="statecheck(this)" value="resistance bands">
                </li>
                <li>    
                    <label for="">Weights</label>
                    <input type="checkbox" name="fitness_extra[]" onchange="statecheck(this)" value="weights">
                </li>
                <li>    
                    <label for="">None</label>
                    <input type="checkbox" name="fitness_extra[]" onchange="statecheck(this)" value="none">
                </li>
            </ul>
        </div>
    </div>
    <div class="tab">
        <h2>How satisfied are you with your current diet when it comes to nutrition?</h2>
        <p>You don’t have to eat less to get fit – but you do have to eat right.</p>
        <div class="reg-content-wrapper">
            <ul>
                <li>
                    <label for="">Very satisfied</label>
                    <input type="radio" name="satisfied" onclick="radioClicked(this)" value="Very satisfied">
                </li>
                <li>
                    <label for="">Satisfied</label>
                    <input type="radio" name="satisfied" onclick="radioClicked(this)" value="Satisfied">
                </li>
                <li>
                    <label for="">Somewhat satisfied</label>
                    <input type="radio" name="satisfied" onclick="radioClicked(this)" value="Somewhat satisfied">
                </li>
                <li>
                    <label for="">I could probably do better</label>
                    <input type="radio" name="satisfied" onclick="radioClicked(this)" value="I could probably do better">
                </li>
            </ul>
        </div>
    </div>
    <div class="tab">
        <h2>Which supplements do you take or plan to take?</h2>
        <p>With -----, you can access weight loss supplements, training supplements, and much more!</p>
        <div class="reg-content-wrapper">
            <ul>
                <li>
                    <label for="">Pre-workout supplements</label>
                    <input type="checkbox" name="supplements[]" onchange="statecheck(this)" value="Pre-workout supplements">
                </li>
                <li>    
                    <label for="">Plant protein supplements</label>
                    <input type="checkbox" name="supplements[]" onchange="statecheck(this)" value="Plant protein supplement">
                </li>
                <li>    
                    <label for="">Whey protein supplemenets</label>
                    <input type="checkbox" name="supplements[]" onchange="statecheck(this)" value="Whey protein supplemenets">
                </li>
                <li>    
                    <label for="">Supplements to stay hedrted</label>
                    <input type="checkbox" name="supplements[]" onchange="statecheck(this)" value="Supplements to stay hedrted">
                </li>
                <li>    
                    <label for="">None</label>
                    <input type="checkbox" name="supplements[]" onchange="statecheck(this)" value="None">
                </li>
            </ul>
        </div>
    </div>
    <div class="tab">
        <h2>Ready to start seeing results?</h2>
        <p>You're just one step away. Hit "Continue" to get 59% OFF your membership.</p>
    </div>
    <div class="tab">
        <h2>You are one step closer to achieving your health and fitness goals.</h2>
        <p>Enter a valid email address to get started.</p>
        <input type="text" placeholder="Email address">
    </div>
    <div class="tab">
        <h2>Create a Password</h2>
        <p>Create a password to view your offers</p>
        <label for="">Email Address</label>
        <p></p>
        <input type="password" placeholder="Password">
    </div>
    <div style="overflow:auto;">
        <div style="float:right;">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
        </div>
    </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>