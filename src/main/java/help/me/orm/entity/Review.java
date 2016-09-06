package help.me.orm.entity;

import javax.persistence.CascadeType;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.FetchType;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.OneToOne;
import javax.persistence.PrePersist;
import javax.persistence.PreUpdate;
import javax.persistence.Table;
import javax.persistence.Transient;

import org.hibernate.annotations.GenericGenerator;

import com.fasterxml.jackson.annotation.JsonIgnore;

@SuppressWarnings("serial")
@Entity
@Table(name = "review")
public class Review implements java.io.Serializable {
	@JsonIgnore
	private Integer reviewId;

	private double rating;
	private String message;

	@JsonIgnore
	private User reviewer;

	@JsonIgnore
	private User provider;

	@JsonIgnore
	private long createdAt;

	@JsonIgnore
	private long updatedAt;


	/**
	 * Full constructor.
	 *
	 * @param reviewId
	 * @param rating
	 * @param message
	 * @param reviewer
	 * @param provider
	 * @param createdAt
	 * @param updatedAt
	 */
	public Review(Integer reviewId, Float rating, String message, User reviewer, User provider, long createdAt,
			long updatedAt) {
		this.reviewId = reviewId;
		this.rating = rating;
		this.message = message;
		this.reviewer = reviewer;
		this.provider = provider;
		this.createdAt = createdAt;
		this.updatedAt = updatedAt;
	}

	/**
	 * @param rating2
	 * @param message
	 * @param reviewer
	 * @param provider
	 */
	public Review(double rating, String message, User reviewer, User provider) {
		this.rating = rating;
		this.message = message;
		this.reviewer = reviewer;
		this.provider = provider;
	}

	/**
	 *
	 */
	public Review() { }

	@Id
	@GeneratedValue(generator="reviewIncrement")
	@GenericGenerator(name="reviewIncrement", strategy = "increment")
	@Column(name = "reviewId", unique = true, nullable = false)
	/**
	 * @return the reviewId
	 */
	public Integer getReviewId() {
		return reviewId;
	}

	/**
	 * @param reviewId the reviewId to set
	 */
	public void setReviewId(Integer reviewId) {
		this.reviewId = reviewId;
	}

	/**
	 * @return the rating
	 */
	@Column(name = "rating", nullable = false)
	public Double getRating() {
		return rating;
	}

	/**
	 * @param rating the rating to set
	 */
	public void setRating(double rating) {
		this.rating = rating;
	}

	/**
	 * @return the message
	 */
	@Column(columnDefinition = "text", name = "message", nullable = false)
	public String getMessage() {
		return message;
	}

	/**
	 * @param message the message to set
	 */
	public void setMessage(String message) {
		this.message = message;
	}

	/**
	 * @return the reviewer
	 */
	@JoinColumn(name="reviewer")
	@OneToOne(fetch=FetchType.LAZY, cascade=CascadeType.ALL)
	public User getReviewer() {
		return reviewer;
	}

	/**
	 * @param reviewer the reviewer to set
	 */
	public void setReviewer(User reviewer) {
		this.reviewer = reviewer;
	}

	/**
	 * @return the provider
	 */
	@JoinColumn(name="provider")
	@OneToOne(fetch=FetchType.LAZY, cascade=CascadeType.ALL)
	public User getProvider() {
		return provider;
	}

	/**
	 * @param provider the provider to set
	 */
	public void setProvider(User provider) {
		this.provider = provider;
	}

	/**
	 * @return the createdAt
	 */
	@Transient
	public long getCreatedAt() {
		return createdAt;
	}

	/**
	 * @return the updatedAt
	 */
	@Transient
	public long getUpdatedAt() {
		return updatedAt;
	}

	@PrePersist
	@Transient
	public void setCreatedAt() {
		this.createdAt = System.currentTimeMillis();
		this.updatedAt = this.createdAt;
	}

	@PreUpdate
	@Transient
	public void setUpdatedAt() {
		this.updatedAt = System.currentTimeMillis();
	}
}
