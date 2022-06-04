@props(['defaultLogo' => false])


<style type="text/css">
    @media screen and (min-width: 1000px){
        .logo{
            height: 2rem ;
            width: auto;
        }
    }

    @media screen and (max-width: 1000px) and (min-width: 500px){
        .logo{
            height: 1.5rem ;
            /*width: 6rem;*/
        }
    }

    @media screen and (max-width: 700px){
        .logo{
            height: 1rem ;
            
        }
    }

</style>

<image src="{{ appLogo($defaultLogo) }}" style="width: 100%;
    height: 100%;" />

