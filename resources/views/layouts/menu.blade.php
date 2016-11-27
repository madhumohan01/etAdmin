<li class="{{ Request::is('sections*') ? 'active' : '' }}">
    <a href="{!! route('sections.index') !!}"><i class="fa fa-edit"></i><span>Sections</span></a>
</li>

<li class="{{ Request::is('places*') ? 'active' : '' }}">
    <a href="{!! route('places.index') !!}"><i class="fa fa-edit"></i><span>Places</span></a>
</li>

<li class="{{ Request::is('aEmails*') ? 'active' : '' }}">
    <a href="{!! route('aEmails.index') !!}"><i class="fa fa-edit"></i><span>AEmails</span></a>
</li>

<li class="{{ Request::is('aPosts*') ? 'active' : '' }}">
    <a href="{!! route('aPosts.index') !!}"><i class="fa fa-edit"></i><span>APosts</span></a>
</li>

<li class="{{ Request::is('keywords*') ? 'active' : '' }}">
    <a href="{!! route('keywords.index') !!}"><i class="fa fa-edit"></i><span>Keywords</span></a>
</li>

