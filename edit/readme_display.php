<?php

echo '<div class="readme-header-container">
  <div class="container left-container">
    <h4>Readme</h4>
  </div>
  <div class="upload-readme container right-container">
    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold">Readme</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="display.php" class="form-horizontal" method="post" name="upload_excel" enctype="multipart/form-data">
              <fieldset>
                  <div class="form-group">
                      <label class="col-md-4 control-label" for="filebutton">Select File</label>
                      <div class="col-md-4">
                          <input type="file" name="file" id="readme-file" class="input-large" accept=".xml,.csv">
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-4 col-md-offset-5">
                          <button type="submit" id="submit" name="readme_submit" data-loading-text="Loading...">Submit</button>
                      </div>
                  </div>

              </fieldset>
          </form>

          </div>
        </div>
      </div>
    </div>

    <div class="text-right">';

          if ($privilege) {

            echo'<a href="display.php?id=' .$id. '&edit-readme=TRUE" class="btn btn-default btn-rounded mb-4">Edit</a>';
          }



    echo '<!-- Trigger the modal with a button -->
      <button type="button" class="btn btn-default btn-rounded mb-4 export-file" data-toggle="modal" data-target="#exportReadme">Export</button>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="exportReadme" class="modal fade " role="dialog" style="margin-top: 200px;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title text-left" style="">Readme Export</h3>
      </div>
      <div class="modal-body">
        <div class="modal-format-header">
          <div class="readme-modal-header" style="display:inline-block;">
            <h4>Format</h4>
          </div>
          <div class=""  style="display:inline-block; margin-left:15px;">
            <h4>Layout</h4>
          </div>
        </div>
        <hr>
        <div class="readme-csv">
          <div class="readme-modal-header" style="display:inline-block;">
            <h4>CSV <a data-toggle="tooltip" data-placement="top" title="All Data contains all the columns within the database"><i class="fas fa-info-circle"></i></a></h4>
          </div>
          <div class=""  style="display:inline-block; margin-left:15px;">
            <form class="form-horizontal" action="'. $path . '/export/expcsv_readme.php?id='.$id.'&tbname='.$common_name.'" method="post"  name="upload_excel" enctype="multipart/form-data">';

                    if ($privilege) {
                      echo'<input type="submit" name="export-all" class="btn btn-default btn-rounded mb-4" value="All Data"/>';
                    }


            echo  '<input type="submit" name="export-template" class="btn btn-default btn-rounded mb-4" value="Blank Template"/>
            </form>
          </div>
        </div>
        <div class="readme-xml">
          <div class="readme-modal-header" style="display:inline-block;">
            <h4>XML <a data-toggle="tooltip" data-placement="top" title="The XML file is ESRI compatible"><i class="fas fa-info-circle"></i></a></h4>
          </div>
          <div class=""  style="display:inline-block; margin-left:15px;">

            <form class="form-horizontal" action="'. $path . '/export/expxml_readme.php?id='.$id.'&tbname='.$common_name.'" method="post"  name="upload_excel" enctype="multipart/form-data">';

                  if ($privilege) {
                    echo'<input type="submit" name="export-sde" class="btn btn-default btn-rounded mb-4" value="Sde"/>';
                  }

        echo  '<input type="submit" name="export-sde" class="btn btn-default btn-rounded mb-4" value="Bytes"/>
            </form>
          </div>
        </div>
        <div class="readme-pdf">
          <div class="readme-modal-header" style="display:inline-block;">
            <h4>PDF <a data-toggle="tooltip" data-placement="top" title="The PDF version of the user guide."><i class="fas fa-info-circle"></i></a></h4>
          </div>
          <div class=""  style="display:inline-block; margin-left:15px;">

            <form class="form-horizontal" action="'. $path . '/export/exppdf_readme.php?id='.$id.'&tbname='.$common_name.'" method="post" enctype="multipart/form-data">
              <input type="submit" name="export-opendata" class="btn btn-default btn-rounded mb-4" value="Open Data"/>';

                    if ($privilege) {
                      echo'<input type="submit" name="export-guide" class="btn btn-default btn-rounded mb-4" value="The Guide"/>';
                    }


          echo'  </form>
          </div>
        </div>
        <div class="readme-md">
          <div class="readme-modal-header" style="display:inline-block;">
            <h4>MarkDown <a data-toggle="tooltip" data-placement="top" title="Markdown is a lightweight and easy-to-use syntax for styling all forms of writing on the GitHub platform."><i class="fas fa-info-circle"></i></a></h4>
          </div>
          <div class=""  style="display:inline-block; margin-left:15px;">

            <form class="form-horizontal" action="'. $path . '/export/expmd_readme.php?id='.$id.'&tbname='.$common_name.'" method="post" enctype="multipart/form-data">
              <input type="submit" name="export-opendata" class="btn btn-default btn-rounded mb-4" value="Open Data"/>';

                    if ($privilege) {
                      echo'<input type="submit" name="export-guide" class="btn btn-default btn-rounded mb-4" value="The Guide"/>';
                    }

        echo'  </form>
          </div>
        </div>
        <!-- <div class="readme-sde text-center readme-modal">
          <h4>Sde</h4>

          <form class="form-horizontal" action="'. $path . '/export/expcsv_readme.php?id='.$id.'&tbname='.$common_name.'" method="post"  name="upload_excel" enctype="multipart/form-data">
            <input type="submit" name="Export" class="btn btn-default btn-rounded mb-4" value=".CSV"/>
          </form>
          <form class="form-horizontal" action="'. $path . '/export/expxml_readme.php?id='.$id.'&tbname='.$common_name.'" method="post"  name="upload_excel" enctype="multipart/form-data">
            <input type="submit" name="Expor2xml" class="btn btn-default btn-rounded mb-4" value=".XML"/>
          </form>

          <form class="form-horizontal" action="'. $path . '/export/expmd_readme.php?id='.$id.'&tbname='.$common_name.'" method="post" enctype="multipart/form-data">
            <input type="submit" name="Expor2md" class="btn btn-default btn-rounded mb-4" value=".MD"/>
          </form>

          <form class="form-horizontal" action="'. $path . '/export/exppdf_readme.php?id='.$id.'&tbname='.$common_name.'" method="post" enctype="multipart/form-data">
            <input type="submit" name="Expor2pdf" class="btn btn-default btn-rounded mb-4" value=".PDF"/>
          </form>
        </div> -->


      </div>

    </div>

  </div>
</div>

<div id="wrapper">

  <!-- Top Div -->
  <div id="top-div" class="border-bottom">
      <h5>Common Name <a data-toggle="tooltip" data-placement="top" title="Descriptive name without underscores or abbreviations"><i class="fas fa-info-circle"></i></a></h5>
      <p>' . $common_name . '</p>
      <br>
      <h5>SDE Name <a data-toggle="tooltip" data-placement="top" title="Name of the SDE data set"><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $sde_name .'</p>
      <br>
      <h5>Tags for Guide <a data-toggle="tooltip" data-placement="top" title="Enter search terms for the data set. These will be used to find the data set on the Esri HUB. These tags would be used for the guide."><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $tags_guide .'</p>
      <br>
      <h5>Tags for SDE <a data-toggle="tooltip" data-placement="top" title="Enter search terms for the data set. These will be used to find the data set on the Esri HUB. These tags would be used for the SDE."><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $tags_sde .'</p>
      <br>
      <h5>Summary <a data-toggle="tooltip" data-placement="top" title="One or two line description of the data set"><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $summary .'</p>
      <br>
      <h5>Summary - Update Date <a data-toggle="tooltip" data-placement="top" title="Date the summary was updated"><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $summary_update_date .'</p>
      <br>
      <h5>Description <a data-toggle="tooltip" data-placement="top" title="Concise, high level summary of the data set (no more than one or two paragraphs)."><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $description .'</p>
      <br>
      <h5>Description - Data Location <a data-toggle="tooltip" data-placement="top" title="Data location of the dataset"><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $description_data_loc .'</p>
      <br>
      <h5>Data Steward <a data-toggle="tooltip" data-placement="top" title="The group or division in DCP that is the business owner for the data set."><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $data_steward .'</p>
      <br>
      <h5>Data Engineer <a data-toggle="tooltip" data-placement="top" title="The group or division in DCP that is the technical owner for the data set. The data engineer cleans, prepares, and optimizes the data set under the guidance of the data steward."><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $data_engineer .'</p>
      <br>
      <h5>Credits <a data-toggle="tooltip" data-placement="top" title="For data sets received from an outside source and not modified by DCP, list the outside source. If DCP added value to the data, list both the outside source and DCP."><i class="fas fa-info-circle"></i></a></h5>
      <p>' . $credits .'</p>
      <br>
      <h5>General Constraints Use Limitations <a data-toggle="tooltip" data-placement="top" title="Dataset is being provided by the Department of City Planning (DCP) on DCP\'s website for informational purposes only. DCP does not warranty the completeness, accuracy, content, or fitness for any particular purpose or use of dataset, nor are any such warranties to be implied or inferred with respect to Dataset as furnished on the website."><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $genconst .'</p>
      <br>
      <h5>Legal Constraints Use Limitations <a data-toggle="tooltip" data-placement="top" title="DCP and the City are not liable for any deficiencies in the completeness, accuracy, content, or fitness for any particular purpose or use of the dataset, or applications utilizing Dataset, provided by any third party."><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $legconst .'</p>
      <br>
      <h5>Update Frequency <a data-toggle="tooltip" data-placement="top" title="How often will this data set be updated? For data sets with a regular update schedule, this may be Monthly, Quarterly, or Annually. For one-off data sets, such as those created for a particular study, this may be None planned or As needed."><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $update_freq .'</p>
      <br>
      <h5>Date of Last Update <a data-toggle="tooltip" data-placement="top" title="When was the data set last updated? This should be the date that any processing and quality assurance was complete. It is the release date of the data set."><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $date_last_update .'</p>
      <br>
      <h5>Date of Underlying Data <a data-toggle="tooltip" data-placement="top" title="The “as of” date for the data. For a data set with multiple sources, like MapPLUTO, list each source and the date the data was extracted or received."><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $date_underlying_data .'</p>
      <br>
      <h5>Data Sources and Compilation Process <a data-toggle="tooltip" data-placement="top" title="If applicable, include a link to GitHub. Otherwise, describe how the data was sourced and processed."><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $data_source .'</p>
      <br>
      <h5>Version <a data-toggle="tooltip" data-placement="top" title="If applicable, include the version number, e.g., 17V1 for MapPLUTO"><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $version .'</p>
      <br>
      <h5>Common Uses <a data-toggle="tooltip" data-placement="top" title="Describe any common applications for the dataset (i.e. soft site or CEQR analyses), including primary users of the dataset."><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $common_uses .'</p>
      <br>
      <h5>Data Quality <a data-toggle="tooltip" data-placement="top" title="If known, include information on the overall accuracy and completeness of the data set. (Information on specific fields should be documented in the data dictionary)."><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $data_quality .'</p>
      <br>
      <h5>Caveats <a data-toggle="tooltip" data-placement="top" title="Outline any pitfalls, potential misconceptions, and/or misuses of the data. This will help users determine if the data set is applicable to their use case and help them avoid using the data incorrectly."><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $caveats .'</p>
      <br>
      <h5>Future Plans <a data-toggle="tooltip" data-placement="top" title="If applicable, describe any enhancements planned for the data set."><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $future_plans .'</p>
      <br>
      <h5>Distribution <a data-toggle="tooltip" data-placement="top" title="Who is allowed to use this data set? Specific divisions within DCP, all DCP staff, other city agencies, the public?"><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $distribution .'</p>
      <br>
      <h5>Contact <a data-toggle="tooltip" data-placement="top" title="If known, include contact information for the dataset."><i class="fas fa-info-circle"></i></a></h5>
      <p>'. $contact .'</p>
      <br>';

      if ($privilege) {
        echo'<h5>Data Access <a data-toggle="tooltip" data-placement="top" title="The Guide Specific, path to layers."><i class="fas fa-info-circle"></i></a></h5>
                <p>'.$data_access.'</p><br>';
      }

      echo '</div><!-- /Top Div -->';

 ?>
