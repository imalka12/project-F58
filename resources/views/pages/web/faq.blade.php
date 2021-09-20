@extends('layouts.web.master')

@section('contents')
    <div class="container p-5">
        <div class="row">
            <div class="col-lg-12">
                <h1>FAQs</h1>
                <p>Frequently asked questions</p>
            </div>

            <div class="col-12 px-5 mt-5">
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                How do I post an ad?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                            aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                <p>Posting an ad on Quick Ads is quick and easy! Simply click the yellow <a
                                        href="{{ route('client.login') }}">Post Ad</a> button and follow the instructions.
                                </p>
                                <p>If you are not already logged in, you will need to log in as the first step of posting
                                    your ad.</p>
                                <p>Your ad will go live once it has been reviewed (this usually takes less than 4 hours
                                    during office hours).</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseTwo">
                                How do I delete my ad?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingTwo">
                            <div class="accordion-body">
                                <p>To delete an ad, please go to your ad's page and click on the "Delete ad" option.</p>
                                <p>Tip: you can find your ad easily by logging in to your account and visiting your "My ads"
                                    page!</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseThree">
                                How do I edit my ad?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body">
                                <p>To edit an ad, please go to your ad's page and click on the "Edit ad" option.</p>
                                <p>Tip: you can find your ad easily by logging in to your account and visiting your "My
                                    ads"page!</p>
                                <p>Note: Only you can edit your advertisement within two days after posting.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseFour">
                                How do I set a new password on Quick Ads?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingFour">
                            <div class="accordion-body">
                                <p>To set a new Quick Ads password, please log in to your account, go to the "Settings" page
                                    and enter a new password.</p>
                                <p>If you have forgotten your Quick Ads password, you can:</p>
                                <ul>
                                    <li>go to the log-in page and click on the "Forgot your password?" link</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseFive">
                                How long do ads stay on Quick Ads?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingFive">
                            <div class="accordion-body">
                                <p>Ads appear for 21 days, unless you delete them earlier.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingSix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseSix">
                                I posted an ad but can't find it. What's wrong?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingSix">
                            <div class="accordion-body">
                                <p>Tip: you can keep track of your ads easily by logging in to your account and visiting
                                    your "My ads" page!</p>
                                <p>Your ad may not be live due to one of the following reasons:</p>
                                <ul>
                                    <li>It is still under review - this will show on your My Ads page, under “Ads under
                                        review”</li>
                                    <li>It may have it violated our posting rules - if your ad needs to be edited before it
                                        can be published, this will show on your My Ads page, under “Ads that need editing”
                                    </li>
                                </ul>
                                <p> If you have been waiting longer than 24 hours for a response from us, you may have given
                                    us the wrong contact details when you posted the ad. Try posting again or contact us.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingSeven">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseSeven">
                                Why has my ad been rejected?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingSeven">
                            <div class="accordion-body">
                                <p>All of the ads are manually reviewed - if your ad violates our posting rules it will be
                                    rejected. You can read what changes you have to make before the ad can be approved in
                                    the rejection email.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingEight">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseEight" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseEight">
                                I'm getting contacted about an ad I didn't post. Can you help me?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseEight" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingEight">
                            <div class="accordion-body">
                                <p>Of course. Please contact us and we will help you right away.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingNine">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseNine" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseNine">
                                I haven't received any responses to my ad. What's wrong?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseNine" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingNine">
                            <div class="accordion-body">
                                <p> If you are not receiving responses to our ads, we recommend taking a look at our tips on
                                    how to sell fast.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseTen" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseTen">
                                How does Quick Ads make money?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTen" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingTen">
                            <div class="accordion-body">
                                <p>Quick Ads offers paid features and services that help people promote their ads,
                                    facilitate the sales of advertised items, and give businesses a bigger online presence.
                                </p>
                                <p>These currently include ad promotions, Quick Ads Membership.</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="rules mt-5">
                    <h3>What are the rules for posting on Quick Ads?</h3>
                    <p>We don't allow ads that contain:</p>
                    <ul>
                        <li>Item or service that is illegal in Sri Lanka </li>
                        <li>An item or service that is not located in Sri Lanka</li>
                        <li>An unrealistic offer</li>
                        <li>Offensive language</li>
                        <li>Offensive pictures</li>
                        <li>Pictures that do not match or clearly show the advertised item or service</li>
                        <li>A URL link that is not relevant to the advertised item or service</li>
                        <li>Multiple items in the same ad</li>
                        <li>In addition, once the ad is posted, the product or service in the ad cannot be changed.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    </div>
    </div>
    </div>
@endsection
