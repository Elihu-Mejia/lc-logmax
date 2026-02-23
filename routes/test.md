# Technical Specifications: Gundam F91 MEPE System

The **MEPE** (Metal Peel-off Effect) is a high-limit cooling phenomenon unique to the F91 Gundam. When the Bio-Computer removes all limiters to match the pilot's reaction speed, the suit generates heat beyond the capacity of its standard radiators. 

To prevent a meltdown, the outer layers of the **Multiple Construction Armor (MCA)** are shed, creating "Afterimages with Mass."

---

## 1. Thermal Dissipation Calculus
The shedding process is governed by the necessity to maintain the core temperature ($T_{core}$) below critical failure points. The energy dissipated through armor peeling is defined as:

$$Q_{diss} = \int_{t_0}^{t_1} \left( \frac{T_{core} - T_{limit}}{R_{thermal}} \right) dt$$

* **$Q_{diss}$**: Total heat energy purged via metallic peeling.
* **$T_{core}$**: Real-time temperature of the hybrid dual-reactors.
* **$R_{thermal}$**: Thermal resistance of the MCA composite.

---

## 2. Mass-Afterimage Distribution
The afterimages ($M'$) are not holograms; they are physical clouds of superheated metal. They retain the momentum of the F91 at the millisecond of separation.



$$M'(t) = \sum_{i=1}^{n} \delta \cdot m_{layer} \cdot \vec{v}_{F91}$$

* **$\delta$**: Shedding coefficient (controlled by the Bio-Computer).
* **$m_{layer}$**: Mass of the exfoliated armor particles.
* **$\vec{v}_{F91}$**: Velocity vector of the Mobile Suit at the moment of shedding.

---

## 3. Sensor Confusion Probability
The likelihood of an enemy's automated fire-control system (FCS) locking onto an afterimage instead of the suit is calculated by:

$$P_{decoy} = \frac{\sum M'_{mass}}{\sigma_{sensor} \cdot d}$$

* **$\sigma_{sensor}$**: Resolution limit of the enemy's pursuit sensors.
* **$d$**: Distance between the F91 and the hostile unit.

---

## Technical Summary

| Component | Function | Result |
| :--- | :--- | :--- |
| **MCA Armor** | Multi-layer ceramic/metal composite | Provides the physical material for the afterimages. |
| **Bio-Computer** | Human-Machine Interface | Dynamically manages heat thresholds and peeling rates. |
| **Heat Fins** | Shoulder-mounted radiators | Deploys to maximize surface area for ionization. |

> ### ⚠️ Operational Warning
> Prolonged activation of the MEPE effect results in a **15% reduction in armor thickness** per combat cycle. Excessive use will compromise the structural integrity of the chest and limb joints.