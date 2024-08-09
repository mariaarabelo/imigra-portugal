@extends('layouts.app')

@section('content')

    <div id="breadcrumbs">
        <a href="\">Home</a>
        <p> > </p>
        <p> Help </p>
    </div>

    <div class="help">

        <section>
            <h3>How to use our Q&A</h3>
            <p> Welcome to the Q&A ImigraPortugal help page! Here are some basic instructions on how to use our platform: </p>
            <ul>
                <li>You can ask and answer questions on topics related to immigration, tourism and more.</li>
                <li>To ask a question you need to be registered on the platform and then choose the category where the question belongs.</li>
                <li>To answer a question, you need to be registered on the platform and select the category and then the question you want to answer.</li>
                <li>If you're not happy with your question or answer, you can always edit it or delete.</li>
                <li>You can keep track of all your questions and answers on your personal page.</li>
            </ul>
        </section>

        <section class="faq-section">
            <h3>FAQ</h3>
            <p> Here are some frequently asked questions that can help clarify common concerns. </p>
            <div class="faq-item">
                <div class="faq-question">
                    <li>How do I ask a question?</li>
                </div>
                <div class="faq-answer">
                    <p>You can ask a question by registering on the platform and selecting the appropriate category.</p>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <li>Can I edit my question after I post it?</li>
                </div>
                <div class="faq-answer">
                    <p>Yes, you can edit your question after posting it by going to your question and selecting the edit option.</p>
                </div>
            </div>
            <!-- Add more questions and answers here -->
        </section>

        <section>
            <h3>Contact</h3>
            <p> If you did not find the help you needed in the sections above, please feel free to contact us. </p>
            <p> Email: support@imigraportugal.com </p>
        </section>
    </div>
@endsection