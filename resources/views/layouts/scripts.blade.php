<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,200,300,400,500,600,700">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/tus-js-client@latest/dist/tus.min.js" async></script>
<script src="https://player.vimeo.com/api/player.js" async></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-196609813-1"></script>

<link rel="stylesheet" type="text/css" href="/css/tooltipster.bundle.min.css" />
<link rel="stylesheet" type="text/css" href="/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-borderless.min.css" />
<script type="text/javascript" src="/js/tooltipster.bundle.min.js"></script>

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">

<script>
    $(document).ready(function() {
        $('.tooltip').tooltipster({
            theme: 'tooltipster-borderless',
            delay: 100,
            trigger: ('ontouchstart' in window) ? 'click' : 'hover',
        });
    });
</script>
<style type="text/css">
    @import url(https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap);
    @import url(https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,500;0,600;0,700;0,800;0,900;1,500;1,600;1,700;1,800;1,900&display=swap);
    @import url(https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap);
    @import url(https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,500;0,600;0,700;0,800;0,900;1,500;1,600;1,700;1,800;1,900&display=swap);
    @import url(https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap);
    @import url(https://fonts.googleapis.com/css2?family=Annie+Use+Your+Telescope&display=swap);
    @import url(https://fonts.googleapis.com/css2?family=Handlee&display=swap);
    @import url(https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap);
    @import url(https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap);
</style>


<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link rel="stylesheet" type="text/css" href="/quill/quill-emoji.css">
<script src="/quill/quill-emoji.js" async></script>



<!-- <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-light_blue.min.css" /> -->
<script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>

<link rel="shortcut icon" href="{{ appFavicon() }}">
<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<script src="{{ mix('js/app.js') }}" defer></script>
<script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>

{{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-196609813-1');
</script>


<style type="text/css">
    /* Scroll bar stylings */
    ::-webkit-scrollbar {
        width: 14px;
        height: 14px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: var(--lightestgrey);
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #c7cbd1;
        border-radius: 4px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #9CA3AF;
    }

    /* Tooltip */
    .wrapper {
        position: relative;
        -webkit-transform: translateZ(0); /* webkit flicker fix */
        -webkit-font-smoothing: antialiased; /* webkit text rendering fix */
    }

    .wrapper .tooltip-text {
        text-align: center;
        background: #000000;
        bottom: 100%;
        color: #fff;
        display: block;
        left: -25px;
        margin-bottom: 9px;
        opacity: 0;
        padding: 5px 10px;
        pointer-events: none;
        position: absolute;
        border-radius: 5px;
        width: 90px;
        z-index: 1000000000;
        -webkit-transform: translateY(10px);
        -moz-transform: translateY(10px);
        -ms-transform: translateY(10px);
        -o-transform: translateY(10px);
        transform: translateY(10px);
        -webkit-transition: all .25s ease-out;
        -moz-transition: all .25s ease-out;
        -ms-transition: all .25s ease-out;
        -o-transition: all .25s ease-out;
        transition: all .25s ease-out;
        -webkit-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
        -moz-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
        -ms-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
        -o-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
        box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
    }

    /* This bridges the gap so you can mouse into the tooltip without it disappearing */
    .wrapper .tooltip-text:before {
        bottom: 0px;
        content: " ";
        display: block;
        height: 0px;
        left: 0;
        position: absolute;
        width: 100%;
    }

    /* CSS Triangles - see Trevor's post */
    .wrapper .tooltip-text:after {
        border-left: solid transparent 10px;
        border-right: solid transparent 10px;
        border-top: solid #000000 10px;
        bottom: -5px;
        content: " ";
        height: 0;
        left: 50%;
        margin-left: -13px;
        position: absolute;
        width: 0;
        z-index: 1000000000;
    }

    .wrapper:hover .tooltip-text {
        opacity: 1;
        pointer-events: auto;
        -webkit-transform: translateY(0px);
        -moz-transform: translateY(0px);
        -ms-transform: translateY(0px);
        -o-transform: translateY(0px);
        transform: translateY(0px);
        z-index: 1000000000;
    }

    /* IE can just show/hide with no transition */
    .lte8 .wrapper .tooltip-text {
        display: none;
    }

    .lte8 .wrapper:hover .tooltip-text {
        display: block;
    }
</style>

@php
    $routeName = request()->route()->uri;
    $whitelabelname = appName() ?? "PerkSweet";
    //dd($routeName);

    switch ($routeName) {
        case "slack":
            $top_title = "PerkSweet | Slack Integration";
                $goog_desc = "PerkSweet easily integrates with Slack to further enhance public recognition and go where employees already interact!";
            break;
        case "contact":
            $top_title = "PerkSweet | Get in Touch!";
                $goog_desc = "PerkSweet gives your team a variety of ways to show appreciation. Get started for free or get in touch with a member of the PerkSweet team.";
            break;
        case "about":
            $top_title = "PerkSweet | Small Team, Big Dream";
                $goog_desc = "PerkSweet hopes in the future every company will have an employee rewards platform.";
            break;
        case "inclusion":
            $top_title = "PerkSweet | Create an Inclusive Culture";
                $goog_desc = "Give employees a voice and enable all employees to interact much more freely and in an inclusive manor.";
            break;
        case "appreciation":
            $top_title = "PerkSweet | Show Employees You Care";
                $goog_desc = "Our platform gives your team a variety of ways to show appreciation.";
            break;
        case "pricing":
            $top_title = "PerkSweet | Low Cost, High Impact";
                $goog_desc = "Proven low cost way to lower voluntary turnover and increase productivity.";
            break;
        case "perksweet-connect":
            $top_title = "PerkSweet | Automated Networking";
                $goog_desc = "Our platform enables users to opt-in to allow one-on-one meetings with other members of your company. PerkSweet uses a personalized preference based match making process to automatically make connections and block off available meeting times for you.";
            break;
            case "group-cards":
            $top_title = "PerkSweet | Digital Group Cards";
                $goog_desc = "PerkSweet Group Cards can deliver a powerful message. PerkSweet Group Cards allow you to enter a customizable message and choose from a variety of themes.";
            break;
        case "rewards-process":
            $top_title = "PerkSweet | Public Recognition with Kudos";
                $goog_desc = "Reward people who go above and beyond! PerkSweet allows employees to send Kudos to anyone else at your company accompanied by a customizable message.";
            break;
        case "reduce-turnover":
            $top_title = "PerkSweet | Reduce Turnover, Boost Productivity";
                $goog_desc = "Our platform is proven to reduce turnover and boost productivity. PerkSweet is a low cost way show employees you care and give most of the spend directly to your employees.";
                break;
        default:
                $top_title = "$whitelabelname | Employee Engagement & Rewards Platform";
                $goog_desc = "$whitelabelname gives your team a variety of ways to show appreciation. Show employees you value them with $whitelabelname.";

    }

@endphp


<meta property="og:title" content="{{$top_title}}">
<title>{{$top_title}}</title>
<meta property="og:description" content="{{$goog_desc}}">
<meta name="description" content="{{$goog_desc}}">
<script type="application/ld+json">
{
  "@context": "http://www.schema.org",
  "@type": "article",
  "name": "{{$top_title}}",
  "url": "https://www.perksweet.com",
  "image": "{{url('/other/perksweet.png')}}",
  "logo": "{{url('/other/perksweet.png')}}",
  "description": "{{$goog_desc}}",
  "address": "345 Harrison Ave, Boston, MA 02118",
  "sameAs": [
    "https://twitter.com/perk_sweet/",
    "https://www.linkedin.com/company/perksweet/",
    "https://www.instagram.com/perksweet/",
    "https://slack.com/apps/A023E3TJ2B1-perksweet?tab=more_info",
    "https://www.g2.com/products/perksweet/reviews",
    "https://www.capterra.com/p/233514/PerkSweet/"
  ]
}


</script>
