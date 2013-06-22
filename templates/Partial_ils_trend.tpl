OBJECT SGF 194 {
   LAYER="BEOBACHTEN" [ <-7650,7850> <-6050,9350> ] ".\trend.jpg" 
   TRIGGER FAST_ACTION {
      DLL NAME="CMTrgLoadWnt.dll"
      FASTACT_VERSION=910 FLAGS=30 TIMEOUT=0 FUNCTION="LoadTrendFile"
      DESCRIPTION="Diagramm/Trend öffnen"
      FASTACT_PARAMS="0 <{{Diag_Name}}.CHR> <- Clear context ->"
   }
}
