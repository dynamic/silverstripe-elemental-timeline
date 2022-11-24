<% if $Title && $ShowTitle %><h2 class="element__title">$Title</h2><% end_if %>
<% if $Content %><div class="element__content">$Content</div><% end_if %>


<div class="timeline clearfix">
    <% if $Milestones %>
        <div class="row timeline__nav justify-content-center">
            <a id="timelinetop"></a>
            <ul class="nav">
                <% loop $Milestones %>
                    <li class="nav-item">
                        <a class="nav-link timeline__link" href="#section-{$ID}">$Year</a>
                    </li>
                <% end_loop %>
            </nav>
        </div>

        <div class="row element__timeline__list">
            <% loop $Milestones %>
                <div class="col-md-12">
                    <div class="<% if $Odd %>col-md-6<% else %>col-md-6 offset-md-6<% end_if %>">
                        <div class="card timeline__timeline-piece">
                            <a id="section-{$ID}"></a>
                            <% if $Image %>
                                <img src="$Image.Fill(576,357).URL" class="img-fluid card-img-top">
                            <% end_if %>
                            <div class="card-body">
                                <div class="timeline__copy<% if $Last %> last<% end_if %><% if $Odd %> right<% else %> left<% end_if %>">
                                    <div class="timeline-caret"></div>
                                    <div class="card-body">
                                        <h3 class="card-title">$Year</h3>
                                        <h4>$Title</h4>
                                        <% if $Content %><div class="card-text">$Content</div><% end_if %>
                                        <% if $ElementLink %><p>$ElementLink</p><% end_if %>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <% end_loop %>
        </div>

    <% else %>
        Sections Here
    <% end_if %>
</div>
