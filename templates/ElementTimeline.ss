<% if $Title && $ShowTitle %><h2 class="element__title">$Title</h2><% end_if %>
<% if $Content %><div class="element__content">$Content</div><% end_if %>


<div class="timeline clearfix">
    <% if $Milestones %>
        <div class="clearfix timeline__nav">
            <a id="timelinetop"></a>
            <div class="hr-fade top">
                <div class="fade-left"></div><div class="fade-right"></div>
            </div>
            <% loop $Milestones %>
                <a href="#section-{$ID}" class="timeline__link">$Year</a>
            <% end_loop %>
            <div class="hr-fade bottom">
                <div class="fade-left"></div><div class="fade-right"></div>
            </div>
        </div>


        <div class="clearfix">
            <% loop $Milestones %>
                <div class="timeline__timeline-piece clearfix row">
                    <div class="<% if $Last %>col-md-12<% else_if $Odd %>col-md-6<% else %>col-md-6 col-md-push-6<% end_if %>">
                        <a id="section-{$ID}"></a>
                        <% if $Image && $Last  %>
                            <img src="$Image.Fill(950,333).URL" class="scale-with-grid heightcheck">
                        <% else_if $Image %>
                            <img src="$Image.Fill(576,357).URL" class="scale-with-grid heightcheck">
                        <% end_if %>
                    </div>
                    <div class="<% if $Last %>col-md-12<% else_if $Odd %>col-md-6<% else %>col-md-6 col-md-pull-6<% end_if %>">
                        <div class="timeline__copy<% if $Last %> last<% end_if %><% if $Odd %> right<% else %> left<% end_if %>">
                            <% if not $Last %><div class="timeline-caret"></div><% end_if %>
                            <div class="inner">
                                <p>
                                <span class="year"><span>$Year</span> - </span>
                                <% if $Content %>$Content.Plain<% end_if %>
                                </p>
                                <%--<p class="half-top add-bottom strong"><a href="#timelinetop" class="timeline__link">Back to Top</a></p>--%>
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