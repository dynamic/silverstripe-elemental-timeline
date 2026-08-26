<% if $Title && $ShowTitle %><h2 class="element__title">$Title</h2><% end_if %>
<% if $Content %><div class="element__content">$Content</div><% end_if %>

<% if $Milestones.exists %>
    <%-- Timeline Navigation Pills --%>
    <nav class="timeline-nav mb-5" aria-label="Timeline Navigation">
        <div class="d-flex justify-content-center flex-wrap gap-2">
            <% loop $Milestones %>
                <a href="#milestone-{$ID}" class="btn btn-outline-primary btn-sm timeline-nav-link">$Year</a>
            <% end_loop %>
        </div>
    </nav>

    <%-- Timeline Container with Vertical Line --%>
    <div class="timeline-container position-relative">
        <%-- Desktop Timeline Line --%>
        <div class="timeline-line d-none d-lg-block position-absolute start-50 translate-middle-x bg-primary opacity-75"
             style="width: 3px; top: 0; bottom: 0; z-index: 1;"></div>

        <% loop $Milestones %>
            <div class="timeline-milestone position-relative mb-2<% if not $First %> timeline-overlap<% end_if %>" id="milestone-{$ID}">
                <%-- Timeline Dot --%>
                <div class="timeline-marker d-none d-lg-flex position-absolute start-50 translate-middle bg-primary border border-4 border-white rounded-circle align-items-center justify-content-center text-white fw-bold shadow"
                     style="width: 4rem; height: 4rem; z-index: 10; top: 2.5rem;">
                    <small class="fs-6">$Year</small>
                </div>

                <%-- Content Row with Alternating Layout --%>
                <div class="row align-items-center">
                    <% if $Even %>
                        <%-- Even items: content on right side --%>
                        <div class="col-lg-6 d-none d-lg-block"></div>
                        <div class="col-lg-6 col-12">
                    <% else %>
                        <%-- Odd items: content on left side --%>
                        <div class="col-lg-6 col-12">
                    <% end_if %>
                            <div class="card shadow-lg border-0 timeline-card">
                                <% if $Image %>
                                    <img src="{$Image.Fill(600,300).URL}" class="card-img-top" alt="{$Image.Title.ATT}" loading="lazy">
                                <% end_if %>

                                <div class="card-body">
                                    <%-- Mobile Year Badge --%>
                                    <div class="d-lg-none mb-3">
                                        <span class="badge bg-primary fs-5 px-3 py-2 shadow-sm">$Year</span>
                                    </div>

                                    <% if $Title %>
                                        <h4 class="card-title text-primary mb-3">$Title</h4>
                                    <% end_if %>

                                    <% if $Content %>
                                        <div class="card-text mb-3 text-muted">$Content</div>
                                    <% end_if %>

                                    <% if $ElementLink %>
                                        <div class="mt-auto">
                                            <a href="$ElementLink.URL"
                                               <% if $ElementLink.OpenInNew %>target="_blank" rel="noopener noreferrer"<% end_if %>
                                               class="btn btn-primary btn-sm rounded-pill shadow-sm">$ElementLink.Title</a>
                                        </div>
                                    <% end_if %>
                                </div>
                            </div>
                        </div>
                    <% if not $Even %>
                        <div class="col-lg-6 d-none d-lg-block"></div>
                    <% end_if %>
                </div>
            </div>
        <% end_loop %>
    </div>
<% else %>
    <div class="alert alert-info" role="alert">
        <h4 class="alert-heading">No Timeline Content</h4>
        <p class="mb-0">Add milestones to display your timeline here.</p>
    </div>
<% end_if %>
